<?php
require("models/categories.php");

$categoriesModel = new Categories();

$categories = $categoriesModel->get();


$cart_count = 0;

if(isset($_SESSION["cart"])){
  $cart_count = count($_SESSION["cart"]);
}

require("views/home.php");