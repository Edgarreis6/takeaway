<?php

require("models/categories.php");

$categoriesModel = new Categories();


if(isset($_POST["send"])) {

        
    $extension = strtolower(substr($_FILES["photo"]["name"], -4));
    $newname = md5(time()) .$extension;
    $destination = "./images/categorias/".$newname;

    move_uploaded_file($_FILES["photo"]["tmp_name"], $destination);

    $categories = $categoriesModel->create($_POST, $newname);

        
        echo 'O produto '.$_POST["name"]. " foi adicionado corretamente";
           
}
    require("views/add_categories.php");
   
