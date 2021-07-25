<?php

require("models/categories.php");

$categoriesModel = new Categories();

$categories = $categoriesModel->get();

if(isset($_POST['send']))
{   
    
    $categories_del = $categoriesModel->delete($_POST["category_id"]);

    
    
    }
     

require("views/manage_category.php");