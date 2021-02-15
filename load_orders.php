<?php

  //Connect to MongoDB and select database
  require __DIR__ . '/vendor/autoload.php';
  //Connect to database
  $mongoClient = (new MongoDB\Client);
  //Select database
  $db = $mongoClient->ecommerce;
  //Select a collection 
  $collection = $db->Orders;

  //Start session management
  session_start();

  //Extract logged in user data
  $usrEmail = $_SESSION["loggedInUserEmail"];

  //Create a PHP array with the search criteria
  $findCriteria = [
  "email" => $usrEmail, 
  ];

  $cursor = $db->Orders->find($findCriteria)->toArray();

  $jsonStr = '[';

        foreach ($cursor as $orders){
            $jsonStr .= json_encode($orders);
            $jsonStr .= ',';
        }

        $jsonStr = substr($jsonStr, 0, strlen($jsonStr)-1);
        $jsonStr .= ']';

        echo $jsonStr;


?>