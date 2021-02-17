<?php

    $condition = filter_input(INPUT_POST, '_condition', FILTER_SANITIZE_STRING);
    $search = filter_input(INPUT_POST, '_search', FILTER_SANITIZE_STRING);
    
	//connect to database 
    require __DIR__ . '/vendor/autoload.php';
    $mongoClient = (new MongoDB\Client);
    $db = $mongoClient->ecommerce;

	$collection = $db -> Products;	
    
    //display products
    if ($condition == 0){

    $product = $db->Products->find();
    
    $jsonStr = '[';

        foreach ($product as $products){
            $jsonStr .= json_encode($products);
            $jsonStr .= ',';
        }

        $jsonStr = substr($jsonStr, 0, strlen($jsonStr)-1);
        $jsonStr .= ']';

        echo $jsonStr;

    }

    //display Price ascending 
    if ($condition == 1){

        $product = $db->Products->find(
            [],
            [
                'sort' => ['Price' => 1],
            ]
        );

        $jsonStr = '[';

        foreach ($product as $products){
            $jsonStr .= json_encode($products);
            $jsonStr .= ',';
        }

        $jsonStr = substr($jsonStr, 0, strlen($jsonStr)-1);
        $jsonStr .= ']';

        echo $jsonStr;
    }

    //display Price descending 
    if ($condition == -1){

        $product = $db->Products->find(
            [],
            [
                'sort' => ['Price' => -1],
            ]
        );

        $jsonStr = '[';

        foreach ($product as $products){
            $jsonStr .= json_encode($products);
            $jsonStr .= ',';
        }

        $jsonStr = substr($jsonStr, 0, strlen($jsonStr)-1);
        $jsonStr .= ']';

        echo $jsonStr;
    }


    //display product name ascending 
    if ($condition == 2){

        $product = $db->Products->find(
            [],
            [
                'sort' => ['Title' => 1],
            ]
        );

        $jsonStr = '[';

        foreach ($product as $products){
            $jsonStr .= json_encode($products);
            $jsonStr .= ',';
        }

        $jsonStr = substr($jsonStr, 0, strlen($jsonStr)-1);
        $jsonStr .= ']';

        echo $jsonStr;


    }

    //display product name descending 
    if ($condition == -2){

        $product = $db->Products->find(
            [],
            [
                'sort' => ['Title' => -1],
            ]
        );

        $jsonStr = '[';

        foreach ($product as $products){
            $jsonStr .= json_encode($products);
            $jsonStr .= ',';
        }

        $jsonStr = substr($jsonStr, 0, strlen($jsonStr)-1);
        $jsonStr .= ']';

        echo $jsonStr;
    }


    //Index search for searching 
    if ($condition == 3){

        $collection->createIndex(array('Description' => 'text'));

        $findCriteria = [
            '$text' => [ '$search' => $search]
        ];

        $product = $db->Products->find($findCriteria);

        $jsonStr = '[';

        foreach ($product as $products){
            $jsonStr .= json_encode($products);
            $jsonStr .= ',';
        }

        $jsonStr = substr($jsonStr, 0, strlen($jsonStr)-1);
        $jsonStr .= ']';

        echo $jsonStr;


    }
    
	
?>