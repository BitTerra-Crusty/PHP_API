<?php

     //Headers
     header('Access-Control-Allow-Origin: *'); //allow access for public
     header('Content-Type: application/json'); //Return/acceps json object
     header('Access-Control-Allow-Methods: POST');
     header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, x-Requested-with ');

     include_once '../../config/Database.php'; //allows database class to be accessed on this file
     include_once '../../Models/Product.php'; //allows product class model to be accessed on this file
 
     //instintiate the DB object and connect
     $database = new Database();
     $db = $database->connect();
     
     //instintiate the product object
     $product = new Product($db);
    
     //Get data
     $data = json_decode(file_get_contents("php://input"));

     //Get product
     $product->name = $data->name;
     $product->description = $data->description;
     $product->price = $data->price;
     $product->quantity = $data->quantity;

     //create product
     if($product->create())
     {
        echo json_encode(
            array('message' => 'product created')
        );
     }
     else
     {
        echo json_encode(
            array('message' => 'product Not created')
        );
     }

?>