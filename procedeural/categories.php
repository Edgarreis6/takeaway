<?php   
require("config.php");

$query = $db->prepare("
    SELECT category_id, name, photo 
    FROM categories

");

$query->execute();

$categories = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Takeaway</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="categories.php">Takeaway</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="categories.php">Home</a></li>
            <li><a href="#">Page 2</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>

<!--categories-->
<!-- CAtegories Section Starts Here -->


            
    <!-- Categories Section Ends Here -->
    
    <h2 class="text-center">Delicious Foods</h2>
    
    <section class="categories">
      <div class="container">
<?php  
    foreach($categories as $category){
        echo '
        
            <a  href="products.php?category_id='.$category["category_id"].'"> 
                <div class="box-3 float-container">
                    <img class="img-responsive img-curve" src="../images/categorias/'.$category["photo"].'" 
                    </a>
                    <h3 class="float-text text-center text-white">'.$category["name"].'</h3>
                    </div>
                    
          
          ';
        }
        ?>    
          </div>
        </section>
      
        <ul>
                
        </ul>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>

</html>