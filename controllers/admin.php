<?php
if($_SESSION["user_type"] != "admin"){
    header("Location:./");
    exit;
}
require("models/products.php");

$productsModel = new Products();

require("views/admin.php");

?>