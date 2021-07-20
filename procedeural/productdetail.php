<?php
include("config.php");

if( !isset($_GET["product_id"]) ){
    header("HTTP/1.1 400 Bad Request");
    die(" Request Inválido");
}

$query = $db->prepare("
    SELECT
        product_id, name, description, price,
        photo, stock, category_id
    FROM
        products
    WHERE
        product_id = ?
");

$query->execute([
    $_GET["product_id"]
]);

$product = $query->fetch( PDO::FETCH_ASSOC );

if( empty($product)) {

    header("HTTP/1.1 404 Not Found");
    die("Categoria inválida");
}


?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title><?=$product["name"]?></title>
        <style>
            figure {
                max-width: 30vw;
                position: absolute;
                top: 50px;
                right: 50px;
            }
            figure img {
                width: 100%;
            }
        </style>
    </head>
    <body>
        <h1><?=$product["name"]?></h1>
        <article>
            <div class="description"><?=$product["description"]?></div>
            <figure>
                <img class="photo" src="images/<?=$product["photo"]?>" alt="">
            </figure>
            <div class="price">Preço: <?=$product["price"]?>€</div>
        </article>

<?php
    if($product["stock"] > 0 ){


   
        
?>
        <form method="post" action="cart.php">
            <div>
                <label>
                    Quantidade
                    <input type="number" name="quantity" value="1" min="1" max="<?=$product["stock"]?>" required>
                </label>
                <input type="hidden" name="product_id" value="<?=$product["product_id"]?>">
                <button type="submit" name="send">Adicionar Carrinho</button>
            </div>
        </form>
<?php
    }
    else {
        echo '<p class="zero-stock"> Lamentamos, mas este produto está esgostado de momento</p>';
    }


?>
        <nav>
            <a href="products.php?category_id=<?=$product["category_id"]?>">Voltar</a>
        </nav>
    </body>
</html>






