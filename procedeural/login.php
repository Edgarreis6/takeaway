<?php
require("config.php");

?>
<!DOCTYPE html>
<html lang="pt">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="../procedeural/style.css">
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
      <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>


<section class="main-bg">
        <div class="login-container text-c animated flipInX">
                <div>
                    <h1 class="logo-badge text-whitesmoke"><span class="fa fa-user-circle"></span></h1>
                </div>
                    <h3 class="text-whitesmoke">Efectuar Login</h3>
                    <p class="text-whitesmoke">Takeaway</p>
                <div class="container-content">
                    <form method="post" action="login.php" class="margin-t">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="email@cenas.com" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="*****" required="">
                        </div>
                        <button type="submit" class="form-button button-l margin-b">Sign In</button>
        
                        <a class="text-darkyellow" href="#"><small>Forgot your password?</small></a>
                        <h3 class="text-whitesmoke text-center"><small><a class="text-whitesmoke" href="register.php">Não está registado?</a></small></~h>
                    </form>
                </div>
            </div>
</section>
        
    </body>

</html>