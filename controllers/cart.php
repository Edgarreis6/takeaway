<?php

require("models/products.php");

$products= new Products();


if(isset($_POST["send"])) {
    if(
        !empty($_POST["quantity"]) &&
        !empty($_POST["product_id"]) &&
        is_numeric($_POST["quantity"]) &&
        is_numeric($_POST["product_id"]) &&
        $_POST["quantity"] >= 1
    ) {
            
        $product = $products->getProductsDetails($_POST["product_id"]);
        if( !empty($product) ) {
            $_SESSION[ "cart"][ $product["product_id"] ] = [
                "quantity" => (int)$_POST["quantity"],
                "name" => $product["name"],
                "price" => $product["price"],
                "product_id" => $product["product_id"],
                "stock" => $product["stock"]
            ];
    
        }

    }
}

$cart_count = 0;

if(isset($_SESSION["cart"])){
  $cart_count = count($_SESSION["cart"]);
}
require("views/cart.php");