<?php
if( !isset($_SESSION["user_id"]) ) {
    header("Location:?controller=access&action=login");
    exit;
}

if(!empty($_SESSION["cart"])) {

    require("model/orders.php");
    $modelOrders = new Orders;

    $order_id = $modelOrders->create( $_SESSION["cart"] );

    if(!empty( $order_id )) {

        unset($_SESSION["cart"]);

        $message = "A sua encomenda número " .$order_id. " foi efecutada com sucesso.";
    }
    else {
        $message = "Ocorreu um erro na sua encomenda";
    }
}
else {
    header("Location:?controller=cart.php");
    exit;
}

require("view/checkout.php");
