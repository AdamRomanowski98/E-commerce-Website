<?php

    $condition = filter_input(INPUT_POST, '_condition', FILTER_SANITIZE_STRING);
    
	
    require __DIR__ . '/vendor/autoload.php';
    $mongoClient = (new MongoDB\Client);
    $db = $mongoClient->ecommerce;

	$collection = $db -> Products;		

    $product = $db->Products->find();
    
    $jsonStr = '[';

        foreach ($product as $products){
            $jsonStr .= json_encode($products);
            $jsonStr .= ',';
        }

        $jsonStr = substr($jsonStr, 0, strlen($jsonStr)-1);
        $jsonStr .= ']';

        echo $jsonStr;

?>