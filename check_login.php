<?php
    //Start session management
    session_start();


    //Check if user logged in
    if( array_key_exists("loggedInUserEmail", $_SESSION) ){
        echo "ok";
    }
    else{
        echo 'Not logged in.';
    }

?>