<?php
require("config.php");

if(!isset($_GET["product_id"])){
    header("HTTP/1.1 400 Bad Request");
    die("Request inválido");
}

$query = $db->prepare("
    SELECT product_id, name, description, price, photo, stock, category_id
    FROM products
    WHERE product_id = ?

");

$query->execute([
    $_GET["product_id"]
]);

$product = $query->fetch( PDO::FETCH_ASSOC);

if(empty($product)){
    header("HTTP/1.1 404 Not Found");
    die("Produto inválido");
}
?>

<!DOCTYPE html>
<html lang="pt">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$product["name"]?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="categories.php">Takeaway</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="categories.php">Home</a></li>
            <li><a href="#">Page 2</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>

        <h1><?=$product["name"]?></h1>
        <article>
            <div class="description"><?=$product["description"]?></div>
            <figure>
                <img class="photo" src="../images/produtos/<?=$product["photo"]?>" alt="foto">
            </figure>
            <div class="price"> Preço <?=$product["price"] ?>€</div>
        </article>

<?php
    if($product["stock"] >0) {
?>
        <form method="post" action="cart.php">
            <div>
                <label>
                    Quantidade
                    <input type="number" name="quantity" value="1" min=1 max="<?=$product["stock"]?>" required>
                </label>
                <input type="hidden" name="product_id" value="<?=$product["product_id"]?>">
                <button type="submit" name="send">Adicionar Carrinho</button>
            </div>
        </form>

<?php
    }
    else {
      echo '<p>Lamentamos, mas este produto está esgotado</p>';
    }
?>
        <br>
        <button>
            <a href="./category_id=<?=$product["category_id"]?>" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Voltar</a>
        </button>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>

</html>

