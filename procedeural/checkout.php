<?php
include("config.php");

/* verificar se o utilizador está logado */
if( !isset($_SESSION["user_id"]) ) {
    header("Location: login.php");
    exit;
}

if( !empty($_SESSION["cart"])) {

    $query = $db->prepare("
    INSERT INTO orders
    (user_id )
    VALUES(? )
        
    ");
    $query->execute([
        $_SESSION["user_id"]
    ]);

    $order_id = $db->lastInsertId();

    foreach($_SESSION["cart"]as $item) {
        $query = $db->prepare("
            INSERT INTO orderdetails
            (order_id, product_id, quantity, price_each)
            VALUES(?, ?, ?, ?)
        
        ");

        $query->execute([
            $order_id,
            $item["product_id"],
            $item["quantity"],
            $item["price"]
        ]);

        $query = $db->prepare(" 
        UPDATE products
        SET stock = stock - ?
        WHERE product_id = ?
        
        ");
           
        $query->execute([

            $item["quantity"],
            $item["product_id"]
        ]);
    }

    unset($_SESSION["cart"]);

    echo "Encomenda #" . $order_id . "criada com sucesso, efectue pagamento para a referencia MB 2946545656";

}
else {
    echo "Coloque artigod no carrinho para poder efectuar uma encomenda";
}