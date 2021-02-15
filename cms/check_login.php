<?php
    //Start session management
    session_start();
    
    if( array_key_exists("loggedInAdmin", $_SESSION) ){
        echo "ok";
    }
    else{
        echo 'Not logged in.';
    }

?>