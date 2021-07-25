<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Categorias</title>
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
                <li><a href="?controller=managecategory">Category</a></li>
                <li><a href="manage_product.php">Products</a></li>
                <li><a href="manage_order.php">Orders</a></li>
                <li><a href="?controller=home">Mainpage</a></li>
            </ul>
        </div>
    </div>

    


<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

      
        <br><br>

        <form action="?controller=add_categories" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="name" placeholder="Category Title" required>
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="photo" required>
                    </td>
                </tr>

              

                <tr>
                    <td colspan="2">
                        <input type="submit" name="send" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

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