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
      <a class="navbar-brand" href="./">Takeaway</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="./">Home</a></li>
            <li><a href="#">Page 2</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="?controller=cart"><span class="glyphicon glyphicon-shopping-cart"></span> Carrinho (<?=$cart_count?>)</a></li>
<?php
  if(!isset($_SESSION["user_id"])){
?>
      <li><a href="?controller=access&action=register"><span class="glyphicon glyphicon-user"></span>Criar Conta</a></li>
      <li><a href="?controller=access&action=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
<?php
    }
    else{
?>
      <li><a href="?controller=access&action=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
<?php
  }
?>

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
        <th scope="col">Remover</th>

        </tr>
    </thead>
    <tbody>
<?php    
        $total = 0;
       foreach($_SESSION["cart"] as $product) {
           $subtotal = $product["price"] * $product["quantity"];
           $total = $total + $subtotal;
           echo '
        <tr data-product_id="'.$product["product_id"].'" data-price="'.$product["price"].'">
            <td>'.$product["name"].'</td>
            <td>
                <input class="quantity" type="number" value="'.$product["quantity"].
                '" min="1" max="'.$product["stock"].'">
            </td>
            <td>'.$product["price"].'</td>
            <td><span class="subtotal">'.$subtotal.'</span>€</td>
            <td>
                <button class="remove" type= "button">X</button>
            </td>
            
        </tr>
        ';
    }
?>    
    <tr>
        <td colspan="3"></td>
        <td colspan="2"><span class="total"><?=$total?></span>€</td>
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
            <a href= "?controller=checkout" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Finalizar Encomenda</a>
        </button>


<script>

document.addEventListener("DOMContentLoaded", () => {
    const removeButtons = document.querySelectorAll(".remove");
    const quantityInputs = document.querySelectorAll(".quantity");

    function recalculateTotal() {
        let total = 0;
        for (let subtotal of document.querySelectorAll(".subtotal")) {

            total = total + Number(subtotal.textContent);

        }
        document.querySelector(".total").textContent = total;

    }





    function recalculateSubTotals(element) {

        const tr = element.parentNode.parentNode;
        const price = tr.dataset.price;
        const quantity = element.value;

        tr.querySelector(".subtotal").textContent = price * quantity;

        recalculateTotal()

    }



    for (let button of removeButtons) {
        button.addEventListener("click", () => {

            const tr = button.parentNode.parentNode;
            const product_id = tr.dataset.product_id;
            
            fetch("/?controller=requests", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"

                    },
                    body: "request=removeProduct&product_id=" + product_id
                })
                .then(response => response.json())
                .then(parsedResponse => {
                    if (parsedResponse.status == "ok") {
                        tr.remove();

                        recalculateTotal();
                    }
                });


        });
    }

    for (let input of quantityInputs) {
        input.addEventListener("change", () => {
            const tr = input.parentNode.parentNode;
            const product_id = tr.dataset.product_id;
            const quantity = input.value;

            fetch("/?controller=requests", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"

                    },
                    body: "request=changeQuantity&product_id=" + product_id + "&quantity=" + quantity
                })
                .then(response => response.json())
                .then(parsedResponse => {
                    if (parsedResponse.status == "ok") {
                        recalculateSubTotals(input);
                    }
                });

        });

    }
});
</script>
    </body>

</html>
