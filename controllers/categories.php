<?php

require("models/categories.php");

$model = new Categories;

if( !empty($action) ) {

    $categories = $model->get($action );

    if( empty($categories) ) {
        header("HTTP/1.1 404 Not Found");
        die("Não encontrado");
    }

    require("view/home.php");
}
else {
    $categories = $model->get();
}
    require("views/home.php");
