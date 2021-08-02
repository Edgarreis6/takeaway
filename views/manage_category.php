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
    <h1>Manage Category</h1>

    <br><br>

    <a href="?controller=add_categories" class="btn-primary">Add Category</a>

    <br /><br /><br />

    <table class="tbl-full">
    <tr>
        <th>Number</th>
        <th>Title</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>

<?php 
    $sn=1;
    foreach($categories as $category){
?>
    <tr>
        <td><?= $sn++; ?>. </td>
        <td><?= $category["name"]; ?></td>
        <td>

<?php  
    if($category["photo"]!="")
    {
?>
        <img src="./images/categorias/<?=$category["photo"];?>" width="100px" >
<?php
    }
        else
        {
        echo "<div class='error'>Image not Added.</div>";
        }
?>
        </td>
    
    <form method="POST"action="?controller=manage_category">
            <td>
                <a href="?controller=update_category&id=<?=$category["category_id"]?>"class="btn-secondary">Update Category</a>
                <input type="hidden" name="category_id" value="<?=$category["category_id"]?>">
                <button name="send" type="submit"  class="btn-danger" >Delete Category</button>  
            </td>
    </form>

<?php

}
    
?>


    </table>
    </div>

    </div>

<?php include('partials/footer.php'); ?>