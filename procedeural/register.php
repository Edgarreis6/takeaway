<?php
require("config.php");

echo "<pre>",
print_r($_POST);
echo "</pre>";



if(isset($_POST["send"])) {
        if( 
            filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)&&
            $_POST["password"] === $_POST["password_confirm"] &&
            checkdate($_POST["month"], $_POST["day"], $_POST["year"])&&
            mb_strlen($_POST["name"]) >= 3 &&
            mb_strlen($_POST["name"]) <= 60 &&
            mb_strlen($_POST["password"]) >= 8 &&
            mb_strlen($_POST["password"]) <= 1000 &&
            mb_strlen($_POST["phone"]) >= 9 &&
            mb_strlen($_POST["phone"]) <= 30 &&
            mb_strlen($_POST["address"]) >= 5 &&
            mb_strlen($_POST["address"]) <= 120 &&
            mb_strlen($_POST["city"]) >= 2 &&
            mb_strlen($_POST["city"]) <= 50 &&
            mb_strlen($_POST["postal_code"]) >= 4 &&
            mb_strlen($_POST["postal_code"]) <= 8 

        ) {
            $query = $db->prepare("
            INSERT INTO users
            (name, email, password, phone, birthdate, address, city, postal_code)
            VALUES(?,?,?,?,?,?,?,?)
            ");

            $query->execute([
                $_POST["name"],
                $_POST["email"],
                password_hash($_POST["password"], PASSWORD_DEFAULT),
                $_POST["phone"],
                $_POST["year"] . "-". $_POST["month"]. "-" . $_POST["day"],
                $_POST["address"],
                $_POST["city"],
                $_POST["postal_code"]
            ]);
            header("Location: login.php");
            

        }
        else {
            $message = "Preencha correctamente todos os campos";
        }
}
?>
<!DOCTYPE html>
<html lang="pt">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Criar Conta</title>
 <?php
    if(isset($message)) {
        echo '<p role="alert">'.$message.'</p>';
    }
 ?>
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
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>


<section class="main-bg">
        <div class="login-container text-c animated flipInX">
                <div>
                    <h1 class="logo-badge text-whitesmoke"><span class="fa fa-user-circle"></span></h1>
                </div>
                    <h3 class="text-whitesmoke">Criar Conta</h3>
                    <p class="text-whitesmoke">Takeaway</p>
                <div class="container-content">
                    <form method="post" action="register.php" class="margin-t">
                    
                    <div class="form-group">
                            <input type="name" class="form-control" name="name" placeholder="nome" minlength="3" maxlength="60" required>
                        </div>    
                    
                    <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="email@cenas.com" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="password" minlength="8" maxlength="1000" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirm" placeholder="password_confirm" minlength="8" maxlength="1000" required="">
                        </div>
                       <div class="form-group">
                            <input type="text" class="form-control" name="phone" placeholder="Telefone" minlength="9" maxlength="30" required>
                        </div>
                        <div class="form-group"> <p class="text-whitesmoke">Data de Nascimento </p> 
                            <select  name="year" aria-label="Ano">
<?php
 for($i = date("Y")-120; $i <= date("Y")-18; $i++ ) {
    echo '<option class="text-black">' .$i. '</option>';
 }
?>
                            </select>
                            <select name="month" aria-label="Mês">
<?php
 for($i = 1; $i <= 12; $i++ ) {
    echo '<option class="text-black">' .($i < 10 ? "0".$i : $i). '</option>';
 }
?>
                            </select>
                            <select name="day" aria-label="Dia">
  <?php
 for($i = 1; $i <= 31; $i++ ) {
    echo '<option class="text-black">' .($i < 10 ? "0".$i : $i). '</option>';
 }
?>                               
                            </select>
                         <div class="form-group">
                            <input type="text" class="form-control" name="address" placeholder="Morada"  minlength="5" maxlength="120" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="city" placeholder="cidade"  minlength="2" maxlength="50" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="postal_code" placeholder="2000-001"  minlength="4" maxlength="8" required>
                        </div>

  
                        </div>
                        <button type="submit" name="send" class="form-button button-l margin-b">Submeter</button>
        
                        <a class="text-darkyellow" href="#"><small>Forgot your password?</small></a>
                        <p class="text-whitesmoke text-center"><small>Se já está registado</small></p>
                        <a class="text-darkyellow" href="login.php"><small>Login</small></a>
                    </form>
                </div>
            </div>
</section>
    </body>

</html>
