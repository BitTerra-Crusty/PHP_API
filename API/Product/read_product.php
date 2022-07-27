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
    
     //Get ID
     $product->id = isset($_GET['id']) ? $_GET['id'] : die();

     //Get product
     $result = $product->read_product();

     echo json_encode($result);

?>