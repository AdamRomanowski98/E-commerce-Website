<?php

  //Connect to MongoDB and select database
  require __DIR__ . '/vendor/autoload.php';
  //Connect to database
  $mongoClient = (new MongoDB\Client);
  //Select database
  $db = $mongoClient->ecommerce;
  //Select a collection 
  $collection = $db->Products;


  $topKeyWord = filter_input(INPUT_POST, 'topKey', FILTER_SANITIZE_STRING);


  $collection->createIndex(array('Description' => 'text'));


  $findCriteria = [
    '$text' => [ '$search' => $topKeyWord]
];

$cursor = $db->Products->find($findCriteria);

  $jsonStr = '[';

        foreach ($cursor as $products){
            $jsonStr .= json_encode($products);
            $jsonStr .= ',';
        }

        $jsonStr = substr($jsonStr, 0, strlen($jsonStr)-1);
        $jsonStr .= ']';

        echo $jsonStr;

?>