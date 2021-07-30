<?php
require("models/products.php");

$products= new Products();
$product = $products->getProductsDetails($_GET["product_id"]);

$cart_count = 0;

if(isset($_SESSION["cart"])){
  $cart_count = count($_SESSION["cart"]);
}

require("views/product_details.php");