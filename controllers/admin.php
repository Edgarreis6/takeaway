<?php
require("models/products.php");

$productsModel = new Products();

if($_SESSION["user_type"] === "user"){
    header("Location: ./");
    exit;
}
require("views/admin.php");

?>