<?php
require_once("models/orders.php");
require_once("models/products.php");
$modelOrders = new Orders;
$modelproducts = new Products;


if( !isset($_SESSION["user_id"]) ) {
    header("Location:?controller=access&action=login");
    exit;
}

if(!empty($_SESSION["cart"])) {

    

    $order_id = $modelOrders->create( $_SESSION["cart"] );
    
    

    if(!empty( $order_id )) {



        unset($_SESSION["cart"]);

        echo "A sua encomenda número " .$order_id. " foi efecutada com sucesso.";
    }
    else {
        echo  "Ocorreu um erro na sua encomenda";
    }
}
else {
    header("Location:?controller=cart.php");
    exit;
}

require("views/checkout.php");
