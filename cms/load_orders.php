<?php

    
require __DIR__ . '/vendor/autoload.php';
$mongoClient = (new MongoDB\Client);
$db = $mongoClient->ecommerce;

$collection = $db -> Orders;		

  $cursor = $db->Orders->find();

  $jsonStr = '[';

        foreach ($cursor as $orders){
            $jsonStr .= json_encode($orders);
            $jsonStr .= ',';
        }

        $jsonStr = substr($jsonStr, 0, strlen($jsonStr)-1);
        $jsonStr .= ']';

echo $jsonStr;