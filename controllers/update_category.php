<?php

require("models/categories.php");

$categoriesModel = new Categories();


if(isset($_GET['id']))
{
    //Get the ID and all other details
    //echo "Getting the Data";
    $id = $_GET['id'];
    
    $categories = $categoriesModel->getDetails($id);
}

if(isset($_POST["send"])){

   $id = $_POST["id"];
   $name = $_POST["name"];
       
    
    $extension = strtolower(substr($_FILES["photo"]["name"], -4));
    $newname = md5(time()) .$extension;
    $destination = "./images/categorias/".$newname;
    print_r($destination);
    print_r($newname);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $destination);
    

   
    $categories = $categoriesModel->update($_POST, $newname);   
    
    echo 'O produto '.$_POST["name"]. " foi adicionado corretamente";
        $message = 'The product with the id '.$_POST["id"].' and with the name of ' .$_POST["name"].' was updated successfully';
   
}   
require("views/update_categories.php");
?>
