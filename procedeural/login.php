<?php
include("config.php");
 
if(isset($_POST["send"])) {
 
    if(
        filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
        mb_strlen($_POST["password"]) >= 8 &&
        mb_strlen($_POST["password"]) <= 1000
    ) {
        $query = $db->prepare("
            SELECT user_id, password AS password_encrypted
            FROM users
            WHERE email = ?
        ");
 
        $query->execute([
            $_POST["email"]
        ]);
 
        $user = $query->fetch();
 
        /* confirmar que utilizador existe e que a
           password enviada é comparável à encriptada na BD */
        if(
            !empty($user) &&
            password_verify($_POST["password"], $user["password_encrypted"])
        ) {
            /* marcar que o utilizador está logado para o site todo */
            $_SESSION["user_id"] = $user["user_id"];
 
            header("Location: cart.php");
        }
        else {
            $message = "Dados incorrectos(2)";            
        }
    }
    else {
        $message = "Dados incorrectos(1)";
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Efectuar Login</title>
    </head>
    <body>
        <h1>Efectuar Login</h1>
<?php
    if(isset($message)) {
        echo '<p role="alert">' .$message. '</p>';
    }
?>
        <p>Se ainda não tiver uma conta, <a href="register.php">registe-se aqui</a></p>
        <form method="post" action="login.php">
            <div>
                <label>
                    Email
                    <input type="email" name="email" required>
                </label>
            </div>
            <div>
                <label>
                    Password
                    <input type="password" name="password" required minlength="8" maxlength="1000">
                </label>
            </div>
            <div>
                <button type="submit" name="send">Enviar</button>
            </div>
        </form>
    </body>
</html>
