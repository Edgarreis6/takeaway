<?php
require("models/products.php");

header("Content-Type: application/json");
$products= new Products();


if(!isset($_POST["request"])) {
    header("HTTP/1.1 400 Bad Request");
    die('{"status":"Error"}');
}

if($_POST["request"] === "removeProduct" &&
!empty($_POST["product_id"]) &&
is_numeric($_POST["product_id"])
) {
    
    unset($_SESSION["cart"][ (int)$_POST["product_id"]]);
    echo '{"status":"ok"}';
    
}
else if($_POST["request"]=== "changeQuantity" &&
!empty($_POST["product_id"]) &&
is_numeric($_POST["product_id"])&&
!empty($_POST["quantity"]) &&
is_numeric($_POST["quantity"])&&
(int)$_POST["quantity"] > 0
){
    $product = $query->fetch();
       

    if(!empty($product)) {
        $_SESSION["cart"][$product["product_id"] ] ["quantity"] = (int)$_POST["quantity"];
        
        echo '{"status":"ok"}';

    }
}
