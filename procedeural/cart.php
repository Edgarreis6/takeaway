<?php
require("config.php");




/* Processo de Validação*/

if(isset($_POST["send"])) {
   
    if(
        !empty($_POST["quantity"]) &&
        !empty($_POST["product_id"]) &&
        is_numeric($_POST["quantity"]) &&
        is_numeric($_POST["product_id"]) &&
        $_POST["quantity"] >= 1
    ) {
        $query = $db->prepare("
        SELECT product_id, name, price
        FROM products
            WHERE product_id = ? AND stock >= ?
        ");

        $query->execute([
            $_POST["product_id"],
            $_POST["quantity"]
        ]);

        $product = $query->fetch();
        
        if( !empty($product) ) {
            $_SESSION["cart"][ $product["product_id"] ] = [
                "quantity" => $_POST["quantity"],
                "name" => $product["name"],
                "price" => $product["price"],
                "product_id" => $product["product_id"]
            ];
    
        }

        header("Location: cart.php");
    }
}

?>
<!DOCTYPE html>
<html lang="pt">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Carrinho de Compras</title>

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
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>



<?php
      if( !empty ($_SESSION["cart"]) ){
?>
        <table class="table table-bordered">
    <thead>
        <tr>
        <th scope="col">Nome</th>
        <th scope="col">Quantidade</th>
        <th scope="col">Preço Unidade</th>
        <th scope="col">Total</th>

        </tr>
    </thead>
    <tbody>
<?php    
        $total = 0;
       foreach($_SESSION["cart"] as $item) {
           $subtotal = $item["price"] * $item["quantity"];
           $total = $total + $subtotal;
           echo '
        <tr>
            <td>'.$item["name"].'</td>
            <td>'.$item["quantity"].'</td>
            <td>'.$item["price"].'</td>
            <td>'.$subtotal.'€</td>
            
        </tr>
        ';
    }
?>    
    <tr>
        <td colspan="3"></td>
        <td><?=$total?>€</td>
    </tr>
    </tbody>
        </table>


<?php   
    }
        else {
            echo "Não tem nada no carrinho";
        }

    ?>
      <button>
            <a href= "checkout.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Finalizar Encomenda</a>
        </button>

     
    </body>

</html>


