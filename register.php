<?php


    require __DIR__ . '/vendor/autoload.php';

    //Connect to database
    $mongoClient = (new MongoDB\Client);

    //Select a database
    $db = $mongoClient->ecommerce;
    
    //Select a collection 
    $collection = $db->Customers;

    //Extract the data that was sent to the server
    $name = filter_input(INPUT_POST, '_name', FILTER_SANITIZE_STRING);
	$surname = filter_input(INPUT_POST, '_surname', FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST, '_email', FILTER_SANITIZE_STRING);
	$phone = filter_input(INPUT_POST, '_phone', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, '_password', FILTER_SANITIZE_STRING);
	$address = filter_input(INPUT_POST, '_address', FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, '_city', FILTER_SANITIZE_STRING);
    $postCode = filter_input(INPUT_POST, '_postCode', FILTER_SANITIZE_STRING);	

    //check if all details provided 
    if($name != "" && $surname != "" && $email != "" && $phone != "" && $password != "" && $address != "" && $city != "" && $postCode != ""){

    $findCriteria = [
        "email" => $email,
    ];

    $cursor = $db->Customers->findOne($findCriteria);



    //Check if e-mail arleady exists
    if(!empty($cursor)){
        echo 'E-mail taken';
    }

    else{
    //Convert to PHP array
    $dataArray = [
        "firstName" => $name,
        "lastName" => $surname,
        "email" => $email,
        "phone" => $phone,
        "password" => $password,
        "address" => $address,
        "city" => $city,
        "postCode" => $postCode
    ];
  

    $insertResult = $collection -> insertOne($dataArray);


     //Echo result back to user
     if($insertResult->getInsertedCount()==1){
        echo 'Welcome ' . $name . ', your account has been created';
    }
    else {
        echo 'Error adding customer';
    }
    }
    
    }else{
        echo 'Please enter all details!';
    }

   


?>


