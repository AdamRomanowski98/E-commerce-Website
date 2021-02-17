<?php

    //Connect to MongoDB and select database
    require __DIR__ . '/vendor/autoload.php';
    //Connect to database
    $mongoClient = (new MongoDB\Client);
    //Select database
    $db = $mongoClient->ecommerce;
    //Select a collection 
    $collection = $db->Orders;


    $name = filter_input(INPUT_POST, '_name', FILTER_SANITIZE_STRING);
    $surname = filter_input(INPUT_POST, '_surname', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, '_phone', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, '_address', FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, '_city', FILTER_SANITIZE_STRING);
    $postCode = filter_input(INPUT_POST, '_postCode', FILTER_SANITIZE_STRING);
    $total= filter_input(INPUT_POST, 'total', FILTER_SANITIZE_STRING);
    $prdtotal= filter_input(INPUT_POST, 'prdtotal', FILTER_SANITIZE_STRING);
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
    $basket = filter_input(INPUT_POST, 'basket', FILTER_SANITIZE_STRING);

    //Check if all details provided 
    if($name != "" && $surname != "" && $phone != "" && $address != "" && $city != "" && $postCode != ""){


    //check what customer is logged in 
    session_start();

    if(array_key_exists("loggedInUserEmail", $_SESSION)){
        $email = $_SESSION["loggedInUserEmail"];

        $findCriteria = [
            "email" => $email
        ];
    }

    
    $customerArray = $db->Customers->find($findCriteria)->toArray();

    $customer = $customerArray[0];
    $custID = $customer['_id'];


    //Add new order for logged in customer
    $productArray = [
        
        "custID" => $custID,
        "email" => $email,
        "FirstName" => $name,
        "Surname" => $surname,
        "Phone" => $phone,
        "Address" => $address,
        "City" => $city,
        "PostCode" => $postCode,
        "date" => $date,
        "products" => $basket,
        "productno" => $prdtotal,
        "total" => $total
    ];

    $checkValue = $collection -> insertOne($productArray);
	
    if($insertResult->getInsertedCount()==1){
        echo 'Order has been proceeded';
    }
    else {
        echo 'Error while proceeding your order';
    }

    }else{
        echo 'alert("Please enter all details")';
    }



?>