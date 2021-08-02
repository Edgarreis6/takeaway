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
    <h1>Manage Products</h1>

    <br><br>

    <a href="?controller=add_products" class="btn-primary">Add Products</a>

    <br /><br /><br />

    <table class="tbl-full">
    <tr>
        <th>Number</th>
        <th>Title</th>
        <th>Image</th>
        <th>price</th>
        <th>stock</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>

<?php 

    $sn=1;
    foreach($products as $product){
?>
    <tr>
        <td><?= $sn++; ?>. </td>
        <td><?= $product["name"]; ?></td>
       
        <td>
<?php  
    if($product["photo"]!="")
    {
?>
        <img src="./images/products/<?=$product["photo"];?>" width="100px" >
<?php
    }
        else
        {
        echo "<div class='error'>Image not Added.</div>";
        }
?>
        </td>

        <td><?= $product["price"]; ?></td>
        <td><?= $product["stock"]; ?></td>
        <td>
            <textarea name="description" required minlength="10" maxlength="20000">    
            <?= $product["description"]; ?>´
            </textarea>
        </td>

    
    <form method="POST"action="?controller=manage_products">
            <td>
                <a href="?controller=update_product&id=<?=$product["product_id"]?>"class="btn-secondary">Update Product</a>
                <input type="hidden" name="product_id" value="<?=$product["product_id"]?>">
                <button name="send" type="submit"  class="btn-danger" >Delete Product</button>  
            </td>
    </form>

<?php

}
    
?>


    </table>
    </div>

    </div>
    
<?php include('partials/footer.php'); ?>