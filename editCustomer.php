<?php

    //Connect to MongoDB and select database
    require __DIR__ . '/vendor/autoload.php';
    //Connect to database
    $mongoClient = (new MongoDB\Client);
    //Select database
    $db = $mongoClient->ecommerce;
    //Select a collection 
    $collection = $db->Customers;

    //Extract the data that was sent to the server
    $NewEmail= filter_input(INPUT_POST, 'NewEm', FILTER_SANITIZE_STRING);
    $NewName= filter_input(INPUT_POST, 'NewNam', FILTER_SANITIZE_STRING);
    $NewSurname = filter_input(INPUT_POST, 'NewSur', FILTER_SANITIZE_STRING);
    $NewPhone = filter_input(INPUT_POST, 'NewPh', FILTER_SANITIZE_STRING);
    $NewAddress = filter_input(INPUT_POST, 'NewAdd', FILTER_SANITIZE_STRING);
    $NewCity = filter_input(INPUT_POST, 'NewCit', FILTER_SANITIZE_STRING);
    $NewpostCode = filter_input(INPUT_POST, 'NewPost', FILTER_SANITIZE_STRING);
    


    //look for an e-mail
    $findCriteria = [
        "email" => $NewEmail, 
     ];

     //update customer details
     $updateCriteria = [
        '$set' => [ "firstName" => $NewName, 
                    "lastName" => $NewSurname, 
                    "phone" => $NewPhone,
                    "address" => $NewAddress,
                    "city" => $NewCity,
                    "postCode" => $NewpostCode ]
    ];


    //Find all of the customers that match  this criteria
    $returnVal = $db->Customers->updateOne($findCriteria, $updateCriteria);

    //if modified display message 
    if($returnVal->getModifiedCount()){
        echo 'Customer details has been changed.';
    }

?>