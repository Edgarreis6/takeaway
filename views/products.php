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

    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="./">Takeaway</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="./">Home</a></li>
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



        <h1><?=$products[0]["category"]?></h1>
        <ul>
<?php  
    foreach($products as $product){
        echo '
            <li>
                <a href= "?controller=products_details&product_id='.$product["product_id"].'">'.$product["name"].'</a>
            </li>
        ';
    }
?>    
                
        </ul>


        
    </body>

</html>
