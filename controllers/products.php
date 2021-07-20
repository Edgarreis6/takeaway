<?php
require("models/products.php");

$productsModel = new Products();

if(!isset($_GET["category_id"])){
    header("HTTP/1.1. 400 Bad Request");
    die("Request Inválido");
}


$products = $productsModel->getProduct($_GET["category_id"]);


$cart_count = 0;

if(isset($_SESSION["cart"])){
  $cart_count = count($_SESSION["cart"]);
}

require("views/products.php");


