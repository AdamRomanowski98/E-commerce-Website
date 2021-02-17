<?php
        
        
        $todelete = filter_input(INPUT_POST, 'toBeDeleted', FILTER_SANITIZE_STRING);

        require __DIR__ . '/vendor/autoload.php';

        $mongoClient = (new MongoDB\Client);

        $db = $mongoClient->ecommerce;
        
        $collection = $db -> Orders;	

        //Delete id which has been passed
        $collection->deleteOne(array('_id'=> new MongoDB\BSON\ObjectId($todelete)));
	

        echo 'Order deleted!'
        
      
  
?>	