<?php
	$title = filter_input(INPUT_POST, '_title', FILTER_SANITIZE_STRING);

    if($title != "" ){
    require __DIR__ . '/vendor/autoload.php';
    $mongoClient = (new MongoDB\Client);
	$db = $mongoClient -> ecommerce;
	$collection = $db -> Products;

	$searchProduct = ["Title" => $title];

	$checkValue = $collection -> find($searchProduct);
	
	
	$arr = array();

		foreach ($checkValue as $prod){
			$arr[0] = $prod['Title'];
			$arr[1] = $prod['Price'];
			$arr[2] = $prod['Description'];
			$arr[3] = $prod['Category'];
            $arr[4] = $prod['Manufacturer'];
            $arr[5] = $prod['Image'];
		}
		echo json_encode($arr);
	}else{
		$arr = array();
		$arr[0] = ["0"];
        echo json_encode($arr);
    }
?>	