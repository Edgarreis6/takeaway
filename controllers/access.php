<?php

require("models/users.php");

$userModel = new Users();


if($_GET["action"] === "register") {
    
    if(isset($_POST["send"])){
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
            $user_id = $userModel->create($_POST);
            if(!empty($user_id)) {
                $_SESSION["user_id"] = $user_id;
                header("Location: ./");
            }
            else {
                $message = "Este utilizador já existe";
            }      
        }
        else{
            $message = "Preencha os dados correctamente";
        }
    }

    require("views/register.php");

}
else if ($_GET["action"] === "login") {
    if(isset($_POST["send"])){
        if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
            mb_strlen($_POST["password"]) >= 8 &&
            mb_strlen($_POST["password"]) <= 1000 
        ){
            $user = $userModel->getDetails($_POST["email"]);
            if(!empty($user) &&
            password_verify($_POST["password"], $user["password"] )
          ) {
    
            $_SESSION["user_id"] = $user["user_id"];
            
            header("Location: ./");
          }
          else{
            $message = "Dados incorrectos";
          }
      }
      else{
        $message = "Dados incorrectos"; 
       
        }
    }

    require("views/login.php");
}
else if ($_GET["action"] === "logout") {
    session_destroy();
    header("Location:./");
}

