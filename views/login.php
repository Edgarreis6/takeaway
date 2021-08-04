
<!DOCTYPE html>
<html lang="pt">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>

        <link rel="stylesheet" href="./css/style1.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>

    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="./">Takeaway</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="./">Home</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="?controller=access&action=register"><span class="glyphicon glyphicon-user"></span>Criar Conta</a></li>
      <li><a href="?controller=access&action=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>



<section class="main-bg">
        <div class="login-container text-c animated flipInX">
                <div>
                    <h1 class="logo-badge text-whitesmoke"><span class="fa fa-user-circle"></span></h1>
                </div>
                    <h3 class="text-whitesmoke">Efectuar Login</h3>

                    <?php
  if(isset($message)) {
    echo '<p class="text-whitesmoke" role="alert">'.$message. '</p>';
  }
?>

                    <p class="text-whitesmoke">Takeaway</p>
                <div class="container-content">
                    <form method="post" action="?controller=access&action=login" class="margin-t">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="email@cenas.com" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" minlength="8" maxlength="1000" required="">
                        </div>
                        <button type="submit" name="send" class="form-button button-l margin-b">Sign In</button>
        
                        <a class="text-darkyellow" href="?controller=recover_password"><small>Forgot your password?</small></a>
                        <h3 class="text-whitesmoke text-center"><small><a class="text-whitesmoke" href="?controller=access&action=register">Não está registado?</a></small></~h>
                    </form>
                </div>
            </div>
</section>

    </body>

</html>
