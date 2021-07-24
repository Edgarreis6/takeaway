<?php include('partials/menu.php'); ?>

    <div class="main-content">
    <div class="wrapper">
    <h1>Manage Category</h1>

    <br><br>

    <!-- Button to Add Admin -->
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
   
    <td>
    <a href="?controller=update_category&category_id" class="btn-secondary">Update Category</a>
    <a href="?controller=del_categories&category_id&image_name=<?= $image_name; ?>" class="btn-danger">Delete Category</a>
    </td>

<?php

}

?>


    </table>
    </div>

    </div>

<?php include('partials/footer.php'); ?>