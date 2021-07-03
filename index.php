<?php

$controller = "home";

/* white list de controllers*/

$valid_controllers = ["home", "categories", "ad_home.php"];

if(isset($_GET["controller"]) && in_array($_GET["controller"], $valid_controllers) 
) {
    $controller = $_GET["controller"];
}

require("controllers/" . $controller . ".php");