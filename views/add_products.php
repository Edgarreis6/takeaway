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
        <h1>Adicionar Produtos</h1>

        <br><br>

     
        <br><br>

        <form action="?controller=add_products" method="POST" enctype="multipart/form-data">

    
            <table class="tbl-30">
                <tr>
                    <td>Nome do Produto: </td>
                    <td>
                        <input type="text" name="name" placeholder="Nome do Produto" required>
                    </td>
                </tr>

                <tr>
                    <td>Descrição: </td>
                    <td>
                    <textarea name="description" required minlength="10" maxlength="20000"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Preço: </td>
                    <td>
                        <input type="number" name="price" placeholder="Preço" required>
                    </td>
                </tr>

                <tr>
                    <td>Stock: </td>
                    <td>
                        <input type="numeber" name="stock" placeholder="stock" required>
                    </td>
                </tr>

                    <select name="category_id">
                    <p>Categoria</p>
                                <?php foreach ($categories as $category){ ?>
                                    <option value="<?=$category["category_id"]?>"> <?=$category["name"]?> </option>
                                <?php } ?>
                        </select>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="photo" required>
                    </td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="submit" name="send" value="Adicionar Produto" class="btn-secondary">
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