<?php

require("models/categories.php");

$categoriesModel = new Categories();

$categories = $categoriesModel->get();




require("views/manage_category.php");