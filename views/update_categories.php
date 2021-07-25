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
                    <li><a href="?controller=manage_orders">Order</a></li>
                    <li><a href="?controller=home">Main_Page</a></li>
                </ul>
            </div>
        </div>

    <div class="main-content">
    <div class="wrapper">
    <h1>Update Category</h1>

<?php
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
    }
    else{ header("Location:?controller=manage_category");

    }



?>
    <form action="" method="POST" enctype="multipart/form-data">


<?php 
    foreach($categories as $category){
      
            $name = $category['name'];
            $current_image = $category['photo'];
           


       

    ?>


            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="name" value="<?=$name?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($category["photo"] != "")
                            {
                               
                                ?>
                                <img src="./images/categorias/<?= $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="photo">
                    </td>
                </tr>
               
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <input type="submit" name="send" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        <?php
         }
        ?>
        </form>

<?php include('partials/footer.php'); ?> 

        