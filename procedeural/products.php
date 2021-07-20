<?php
include("config.php");

if( !isset($_GET["category_id"]) ){
    header("HTTP/1.1 400 Bad Request");
    die(" Request Inválido");
}

$query = $db->prepare("
    SELECT
        products.name,
        products.product_id,
        categories.name AS category
    FROM
        products
    INNER JOIN
        categories USING(category_id)
    WHERE
        products.category_id = ?
");

$query->execute([ $_GET["category_id"] ]);

$products = $query->fetchAll( PDO::FETCH_ASSOC );
if( empty($products)) {

    header("HTTP/1.1 404 Not Found");
    die("Categoria inválida");
}
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title><?=$products[0]["category"]?></title>
    </head>
    <body>
        <h1><?=$products[0]["category"]?></h1>
        <ul>
<?php
    foreach($products as $product) {
        echo '
            <li>
                <a href="productdetail.php?product_id=' .$product["product_id"]. '">' .$product["name"]. '</a>
            </li>
        ';
    }
?>
        </ul>
        <nav>
            <a href="categories.php">Voltar</a>
        </nav>
    </body>
</html>