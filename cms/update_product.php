<?php
	$NewPr = filter_input(INPUT_POST, 'NewProduct', FILTER_SANITIZE_STRING);
	$NewPri = filter_input(INPUT_POST, 'NewPrice', FILTER_SANITIZE_STRING);
	$NewPd = filter_input(INPUT_POST, 'NewDescription', FILTER_SANITIZE_STRING);
	$NewPc = filter_input(INPUT_POST, 'NewCategory', FILTER_SANITIZE_STRING);	
    $NewPm = filter_input(INPUT_POST, 'NewManufacturer', FILTER_SANITIZE_STRING);	
    $NewPi = filter_input(INPUT_POST, 'NewImage', FILTER_SANITIZE_STRING);	
	
    
    //Connect to MongoDB and select database
    require __DIR__ . '/vendor/autoload.php';
    //Connect to database
    $mongoClient = (new MongoDB\Client);
    //Select database
    $db = $mongoClient->ecommerce;
    //Select a collection 
    $collection = $db->Products;
		

        $findCriteria = [
            "Title" => $NewPr,
        ];

         $updateProduct = [ 
                '$set' => [
                        "Price" => $NewPri, 
                        "Description" => $NewPd, 
                        "Category" => $NewPc,
                        "Manufacturer" => $NewPm,
                        "Image" => $NewPi]];
        
    
    
        $checkValue = $collection -> updateOne($findCriteria,$updateProduct);	
		echo 'Updated!';
               
?>	
	
