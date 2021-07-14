<?php
require("config.php");

if(!isset($_SESSION["user_id"])){
    header("Location: ?controller=access.php");
    exit;
}

if(!empty($_SESSION["cart"])){

    $query = $db->prepare("
        INSERT INTO orders 
        (user_id)
        VALUES(?)
    ");

    $query->execute([
        $_SESSION["user_id"]
    ]);

    $order_id = $db->lastInsertId();

   
    foreach($_SESSION["cart"] as $item){

    $query = $db->prepare("
        INSERT INTO orderdetails
        (order_id, product_id, quantity, price_each)
        VALUES(?,?,?,?)
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
    header("Location: categories.php");
    

    echo"Encomenda " .$order_id. " criada com sucesso, efectue o pagamento";
}
else{
    echo "Coloque artigos no carrinho para poder efectuar um encomenda";
    
}

?>


<!DOCTYPE html>
<html lang="pt">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$products[0]["category"]?></title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>
<br>
    <button>
            <a href= "categories.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Homepage</a>
        </button>

           
    </body>

</html>

