<?php

require("models/products.php");
require("models/categories.php");




$categoriesModel = new Categories();

$categories = $categoriesModel->get();
$productModel= new Products();

if(isset($_POST["send"])) {
        
    $extension = strtolower(substr($_FILES["photo"]["name"], -4));
    $newname = md5(time()) .$extension;
    $destination = "./images/products/";

    move_uploaded_file($_FILES["photo"]["tmp_name"], $destination.$newname);

    $products = $productModel->createProduct($_POST, $newname);

        
    echo 'O produto '.$_POST["name"]. " foi adicionado corretamente";
           
}
    require("views/add_products.php");
   