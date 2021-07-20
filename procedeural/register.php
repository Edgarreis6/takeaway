<?php

    include("config.php");

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $query = $db->prepare("
        SELECT country_code, country_name
        FROM countries
    ");

    $query->execute();

    $countries = $query->fetchAll( PDO::FETCH_ASSOC );
    
    $country_codes = [];
    foreach($countries as $country){
        $country_codes[] = $country["country_code"];
    }

    if( isset($_POST["send"]) ){

        foreach($_POST as $key => $value) {

            $_POST[$key] = strip_tags(trim($value));
        }


        if(
            filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
            $_POST["password"] === $_POST["password_confirm"] &&
            checkdate($_POST["month"] , $_POST["day"] , $_POST["year"]) &&
            mb_strlen($_POST["password"]) >= 8 &&
            mb_strlen($_POST["password"]) <= 1000 &&
            mb_strlen($_POST["name"]) >= 3 && 
            mb_strlen($_POST["name"]) <= 60 && 
            mb_strlen($_POST["phone"]) >= 9 && 
            mb_strlen($_POST["phone"]) <= 30 &&
            mb_strlen($_POST["address"]) >= 5 && 
            mb_strlen($_POST["address"]) <= 120 &&
            mb_strlen($_POST["postal_code"]) >= 4 && 
            mb_strlen($_POST["postal_code"]) <= 12 &&
            mb_strlen($_POST["city"]) >= 2 && 
            mb_strlen($_POST["city"]) <= 50  &&
            in_array($_POST["country"], $country_codes)
        ) {
            $query = $db->prepare("
                INSERT INTO users
                (name, email, password, phone, birthdate, address, city, postal_code, country)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ? )
            ");
            $query->execute([
                $_POST["name"],
                $_POST["email"],
                password_hash($_POST["password"], PASSWORD_DEFAULT),
                $_POST["phone"],
                $_POST["year"] . "-" . $_POST["month"] . "-" .$_POST["day"],
                $_POST["address"],
                $_POST["city"],
                $_POST["postal_code"],
                $_POST["country"]
            ]);
            header("Location: login.php");

        }
        else{
            $message = "Preencha correctamente todos os campos.";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Criar Conta</title>
    </head>
    <body>
        <h1>Criar Conta</h1>
        <?= isset($message) ? '<p role="alert">'. $message. '</p>' : '' ?>
        <p>Se já tiver uma conta, <a href="login.php">faça login aqui</a></p>
        <form method="post" action="register.php">
            <div>
                <label>
                    Nome
                    <input type="text" name="name" required minlength="3" maxlength="60">
                </label>
            </div>
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
                <label>
                    Repetir Password
                    <input type="password" name="password_confirm" required minlength="8" maxlength="1000">
                </label>
            </div>
            <div>
                <label>
                    Telefone
                    <input type="text" name="phone" required minlength="9" maxlength="30">
                </label>
            </div>
            <div>
                Data Nascimento
                <select name="year" aria-label="Ano">
<?php
    for($i = date("Y")-120; $i <= date("Y")-18; $i++) {
        echo '<option>' .$i. '</option>';
    }
?>
                </select>
                <select name="month" aria-label="Mês">
                <?php
                    for($i= 1; $i <= 12; $i++){
                        echo '<option>'. ($i < 10 ? "0".$i : $i) .'</option>';
                    }
                ?>
                </select>
                <select name="day" aria-label="Dia">
                <?php
                    for($i= 1; $i <= 31; $i++){
                        echo '<option>'. ($i < 10 ? "0".$i : $i) .'</option>';
                    }
                ?>
                </select>
            </div>
            <div>
                <label>
                    Endereço
                    <input type="text" name="address" required minlength="5" maxlength="120">
                </label>
            </div>
            <div>
                <label>
                    Cidade
                    <input type="text" name="city" required minlength="2" maxlength="50">
                </label>
            </div>
            <div>
                <label>
                    Código Postal
                    <input type="text" name="postal_code" required minlength="4" maxlength="12">
                </label>
            </div>
            <div>
                    <label>
                        País
                        <select name="country">
                            <?php
                                foreach($countries as $country){
                                    echo '
                                        <option value="'.$country["country_code"].'"
                                        '. ( $country["country_code"] === "pt" ? " selected" : "" ) .'
                                        >'. $country["country_name"] .'
                                        </option>';
                                }
                            ?>
                        </select>
                    </label>
            </div>
            <div>
                <button type="submit" name="send">Enviar</button>
            </div>
        </form>
    </body>
</html>