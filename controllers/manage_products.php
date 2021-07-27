<?php

require("models/products.php");

$productModel= new Products();

$products = $productModel->get();


if(isset($_POST['send']))
{   
    
    $products_del = $productModel->deleteProduct($_POST["product_id"]);
    
    }
     

require("views/manage_products.php");