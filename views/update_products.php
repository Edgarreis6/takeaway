<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produtos</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>

<div class="menu">
        <div class="wrapper text-center">
            <ul>
                <li><a href="?controller=admin">Home</a></li>
                <li><a href="?controller=manage_category">Category</a></li>
                <li><a href="?controller=manage_products">Products</a></li>
                <li><a href="manage_order.php">Orders</a></li>
                <li><a href="?controller=home">Mainpage</a></li>
            </ul>
        </div>
    </div>




<div class="main-content">
    <div class="wrapper">
        <h1>Products Update </h1>

        <?php
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
    }
    else{ header("Location:?controller=manage_products");

    }

?>
    <br><br>

     
    <br><br>

    <form action="?controller=update_product" method="POST" enctype="multipart/form-data">
        
        <table class="tbl-30">
           
            <select name="category_id">
            <p>Categoria</p>

<?php foreach ($categories as $category){ ?>
    <option value="<?=$category["category_id"]?>"> <?=$category["name"]?> </option>
<?php } ?>
            </select>

<?php foreach ($products as $product){
$current_image = $product["photo"];

}            
?>
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="name" value="<?= $product["name"]; ?>">
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="5"><?= $product["description"]; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price" value="<?= $product["price"]; ?>">
                </td>
            </tr>

            <tr>
                <td>Stock: </td>
                <td>
                    <input type="number" name="stock" value="<?= $product["stock"]; ?>">
                </td>
            </tr>
            <tr>
                <td>Current Image: </td>
                <td>
                    <?php 
                        if($current_image == "")
                        {
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else
                        {
                            ?>
                            <img src="./images/products/<?= $current_image; ?>" width="150px">
                            <?php
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td>Select New Image: </td>
                <td>
                    <input type="file" name="photo">
                </td>
            </tr>

               

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                    <input type="submit" name="send" value="Update Food" class="btn-secondary">
                </td>
            </tr>
        
        </table>

            </table>

        </form>

        

    </div>
</div>


    
    
    <div class="footer">
        <div class="wrapper">
            <p class="text-center">2021 Takeaway </p>
        </div>
        
    </div>

</body>
</html>