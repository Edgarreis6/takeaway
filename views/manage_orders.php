<html>
    <head>
        <title>Takeaway</title>

        <link rel="stylesheet" href="../css/admin.css">
    </head>
    
    <body>
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="?controller=admin">Home</a></li>
                    <li><a href="?controller=manage_category">Category</a></li>
                    <li><a href="?controller=manage_products">products</a></li>
                    <li><a href="#">Order</a></li>
                    <li><a href="?controller=home">Main_Page</a></li>
                </ul>
            </div>
        </div>
        
        <div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

                <br /><br /><br />

                
                <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>Order_id</th> 
                        <th>Order Date</th>
                        <th>customer</th>
                        <th>quantity</th>
                        <th>product</th>

                        <th>address</th>
                        <th>city</th>
                        <th>email</th>
                        <th>phone</th>
                        
                        <th>Actions</th>
                    </tr>

                    <?php 
                              foreach($orders as $order){                                  
                                ?>

                                    <tr>
                                        <td><?= $order["order_id"]; ?>. </td>
                                        <td><?= $order["order_date"]; ?></td>
                                        <td><?= $order["customer"] ?></td>
                                        <td><?= $order["quantity"] ?></td>
                                        <td><?= $order["product_id"] ?></td>


                                        <td><?= $order["address"] ?></td>

                                       

                                        <td><?= $order["city"]  ?></td>
                                        <td><?= $order["email"] ?></td>
                                        <td><?= $order["phone"] ?></td>
                                        <td>
                                            <a href="#" class="btn-secondary">Update Order</a>
                                        </td>
                                    </tr>

                    <?php 
                    }
                    ?>

 
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>