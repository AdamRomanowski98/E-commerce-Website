<?php

require __DIR__ . '/vendor/autoload.php';

//Connect to database
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->ecommerce;

$prdid = filter_input(INPUT_GET, 'prdid', FILTER_SANITIZE_STRING);

//Search for project id
$searchCriteria = [
    "_id" => new MongoDB\BSON\ObjectID($prdid)
];

$foundProduct = $db->Products->find($searchCriteria);

foreach($foundProduct as $products){
    $jsonStr = json_encode($products);
}

echo $jsonStr;


?>