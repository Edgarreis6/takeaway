<?php
require("models/products_details.php");

$products= new Products();

$product = $products->getProductsDetails($_GET["product_id"]);




require("views/product_details.php");