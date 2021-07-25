<?php 

    require("login-check.php");

?>


<html>
    <head>
        <title>Food Order Website - Home Page</title>

        <link rel="stylesheet" href="../css/admin.css">
    </head>
    
    <body>
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="?controller=admin">Home</a></li>
                    <li><a href="?controller=manage_category">Category</a></li>
                    <li><a href="?controller=manage_products">products</a></li>
                    <li><a href="?controller=manage_orders">Order</a></li>
                    <li><a href="?controller=home">Main_Page</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu Section Ends -->