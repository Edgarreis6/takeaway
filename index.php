<?php

$controller = "home";

/* white list de controllers*/

$valid_controllers = ["home", "categories", "products", "products_details",
 "access", "cart", "requests", "checkout", "admin", "add_categories", "manage_category", 
 "update_category" ];

if(isset($_GET["controller"]) && in_array($_GET["controller"], $valid_controllers) 
) {
    $controller = $_GET["controller"];
}

require("controllers/" . $controller . ".php");