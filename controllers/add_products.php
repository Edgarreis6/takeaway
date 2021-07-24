<?php

require("models/products.php");


$productsModel = new Products();

$categoriesModel = new Categories();

$categories = $categoriesModel->get();


if(isset($_POST["send"])) {
        
    $extension = strtolower(substr($_FILES["photo"]["name"], -4));
    $newname = md5(time()) .$extension;
    $destination = "./images/produtos";

    move_uploaded_file($_FILES["photo"]["tmp_name"], $destination.$newname);

    $products = $productsModel->createProduct($_POST, $newname);

        
        echo 'O produto '.$_POST["name"]. " foi adicionado corretamente";
           
}
    require("views/add_products.php");
   