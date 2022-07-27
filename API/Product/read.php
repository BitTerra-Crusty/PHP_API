<?php

    //Headers
    header('Access-Control-Allow-Origin: *'); //allow access for public
    header('Content-Type: application/json'); //Return/acceps json object

    include_once '../../config/Database.php'; //allows database class to be accessed on this file
    include_once '../../Models/Product.php'; //allows product class model to be accessed on this file

    //instintiate the DB object and connect
    $database = new Database();
    $db = $database->connect();
    
    //instintiate the product object
    $product = new Product($db);

    //Read product data
    $result = $product->read();
    
    //Number of rows returned
    $numOfRows = $result->rowCount();

    //check for posts
    if($numOfRows > 0)
    {
        $products_arr = array();
        //$products_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);

            $product_item = array(
                'id' => $id,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'quantity' => $quantity,
            );

            //phush to data
            array_push($products_arr, $product_item);
        }
         //return it as json results
        echo json_encode($products_arr);
    }
    else{
        echo json_decode(
            "No products"
        );
    }
?>