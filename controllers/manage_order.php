<?php

if($_SESSION["user_type"] != "admin"){
    header("Location:./");
    exit;
}

require("models/orders.php");

$ordersModel = new Orders();
$orders = $ordersModel->get();


require("models/products.php");

$productModel= new Products();

$products = $productModel->get();




require("views/manage_orders.php");