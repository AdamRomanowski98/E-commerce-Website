<?php
    //Start session management
    session_start();

    //Get name and address strings - need to filter input to reduce chances of SQL injection etc.
    $login= filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);    

    //Connect to MongoDB and select database
	require __DIR__ . '/vendor/autoload.php';//Include libraries
	$mongoClient = (new MongoDB\Client);//Create instance of MongoDB client
	$db = $mongoClient->ecommerce;
	
    //Create a PHP array with our search criteria
    $findCriteria = [ "login" => $login ];

    //Find all admins that match  this criteria
    $resultArray = $db->Staff->find($findCriteria)->toArray();

   
    if(count($resultArray) == 0){
        echo 'Admin not found';
        return;
    }
    else if(count($resultArray) > 1){
        echo 'Database error.';
        return;
    }
   
    //Get admin and check password
    $admin = $resultArray[0];
    if($admin['password'] != $password){
        echo 'Password incorrect.';
        return;
    }
        
    //Start session for this admin
    $_SESSION['loggedInAdmin'] = $login;
    
    //Inform web page that login is successful
    echo 'ok';  
?>