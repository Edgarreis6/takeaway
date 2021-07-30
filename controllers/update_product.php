<?php

require("models/products.php");
require("models/categories.php");




$categoriesModel = new Categories();

$categories = $categoriesModel->get();
$productModel= new Products();


if(isset($_GET['id']))
{
    
    $id = $_GET['id'];
    $products = $productModel->getProductsDetailsUp($id);
    
}



if(isset($_POST["send"])) {
        

    $id = $_POST["id"];
    $name = $_POST["name"];


    if(isset($_FILES['photo']['name']))
    {
        $image_name = $_FILES['photo']['name']; //New Image NAme

        //CHeck whether th file is available or not
        if($image_name!="")
        {
            $extension = strtolower(substr($_FILES["photo"]["name"], -4));
            $newname = md5(time()) .$extension;
            $destination = "./images/products/";

            $upload = move_uploaded_file($_FILES["photo"]["tmp_name"], $destination.$newname);

            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                header("Location:?controller=manage_products");
                die();
            }
         
        }
        else
        {
            $image_name = $current_image; 
        }
    }
    else
    {
        $image_name = $current_image; 
    }
   

    $products = $productModel->updateProducts($_POST, $newname);

        
    echo 'O produto '.$_POST["name"]. " foi adicionado corretamente";
           
}
    require("views/update_products.php");
   