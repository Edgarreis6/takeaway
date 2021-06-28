<?php

$controller = "home";

/* white list de controllers*/

$valid_controllers = ["home"]

if(isset($_GET["controller"]) && in array($_GET["controller"], $valid_controllers) 
) {
    $controller = $_GET["controller"];
}

require("controllers/".$controller.".php");