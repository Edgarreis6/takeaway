<?php

include("config.php");
//unset($_SESSION["cart"]);
if(isset($_POST)){
  if(
    !empty($_POST["quantity"])&&
    !empty($_POST["product_id"])&&
    is_numeric($_POST["quantity"])&&
    is_numeric($_POST["product_id"])&&
    $_POST["quantity"]>=1
  ) {
    $query = $db->prepare("
      SELECT product_id, stock, price, name, stock
      FROM products
      WHERE product_id=?
        AND stock >=?
    ");
    $query->execute([$_POST["product_id"], $_POST["quantity"]]);
    $product = $query->fetch(PDO::FETCH_ASSOC);

    if(!empty($product)){
      $_SESSION["cart"][$product["product_id"]]=[
        "product_id"=>(int)$product["product_id"],
        "quantity"=>$_POST["quantity"],
        "name"=>$product["name"],
        "price"=>$product["price"],
        "stock"=>$product["stock"]
      ];
    }
    header("Location: cart.php");
  }
}

?>

<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <title>Carrinho</title>
    <style>
      table, tr, th, td{
        border:1px solid #000;
        border-collapse:collapse;
      }
    </style>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
 
 const removeButtons = document.querySelectorAll(".remove");
 const quantityInputs = document.querySelectorAll(".quantity");

 function recalculateSubtotals(element) {

     const tr = element.parentNode.parentNode;
     const price = tr.dataset.price ;
     const quantity = element.value;

     tr.querySelector(".subtotal").textContent = price * quantity;

     recalculateTotal();
 }

 function recalculateTotal() {
     let total = 0;
     for(let subtotal of document.querySelectorAll(".subtotal") ) {
         total = total + Number(subtotal.textContent);
     }
     document.querySelector(".total").textContent = total;
 }

 for(let button of removeButtons) {

     button.addEventListener("click", () => {
       alert("asdasd");
         const tr = button.parentNode.parentNode;
         const product_id = tr.dataset.product_id;
          alert("dasdas");
         fetch("requests.php", {
             method: "POST",
             headers: {
                 "Content-Type":"application/x-www-form-urlencoded"
             },
             body: "request=removeProduct&product_id=" + product_id
         })
         .then( response => response.json() )
         .then( parsedResponse => {
             if( parsedResponse.status == "OK" ) {

                 tr.remove();

                 recalculateTotal();
             }
         });

     });
 }

 for(let input of quantityInputs) {

     input.addEventListener("change", () => {

         const tr = input.parentNode.parentNode;
         const product_id = tr.dataset.product_id;
         const quantity = input.value;

         fetch("requests.php", {
             method: "POST",
             headers: {
                 "Content-Type":"application/x-www-form-urlencoded"
             },
             body: "request=changeQuantity&product_id=" +product_id+ "&quantity=" + quantity
         })
         .then( response => response.json() )
         .then( parsedResponse => {
             if( parsedResponse.status == "OK" ) {

                 recalculateSubtotals( input );
             }
         });

     });
 }
});
    </script>
  </head>
  <body>

<?php
  if(!empty($_SESSION["cart"])){
?>
    <table>
      <tr>
        <th>Nome</th>
        <th>Quantidade</th>
        <th>Preço</th>
        <th>Total</th>
        <th>Remover</th>
      </tr>
<?php
  $total=0;
  foreach($_SESSION["cart"] as $item){
    $subtotal=$item["price"]*$item["quantity"];
    $total+=$subtotal;
    echo '
    <tr data-product_id="'.$item["product_id"].'" data-price="'.$item["price"].'">
      <td>'.$item["name"].'</td>
      <td>
        <input class="quantity" type="number" value="'.$item["quantity"].'" min="1" max="'.$item["stock"].'">
      </td>
      <td>'.$item["price"].'€</td>
      <td><span class="subtotal">'.$subtotal.'</span>€</td>
      <td>
        <button class="remove" type="button">X</button>
      </td>
    </tr>
    ';
  }
  ?>
    <tr>
      <td colspan="3"></td>
      <td colspan="2">
       <span class="total"><?=$total?></span>€</td>
    </tr>

    </table>
<?php
  }else{
    echo "<p>Ainda não está nada no carrinho</p>";
  }
?>
    <nav>
      <a href="index.php">VOLTAR</a>
      <a href="checkout.php">CHECKOUT</a>
    </nav>

  </body>
</html>