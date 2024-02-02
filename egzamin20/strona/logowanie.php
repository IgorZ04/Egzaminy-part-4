<!DOCTYPE html>

<?php

$dbConn = new mysqli('localhost', 'root', '', 'psy');

$error = '';

    if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password2']) && $_POST['login'] != '' && $_POST['password'] != '' && $_POST['password2'] != '') {

        $login = $_POST['login'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        $sql_login_check = "SELECT count(*) FROM `uzytkownicy` WHERE `login` = '$login';";
        $sql_LC_resault = mysqli_fetch_array($dbConn->query($sql_login_check), MYSQLI_BOTH);

        if ($sql_LC_resault[0] == 0) {

            if ($password == $password2) {

                $password3 = sha1($password);
                $sql_add_user = "INSERT INTO `uzytkownicy`(`id`, `login`, `haslo`) VALUES ('','$login','$password3')";
                $dbConn->query($sql_add_user);
                header("Location: logowanie.php");

            } else {

                $error = "<p>hasła nie są takie same, konto nie zostało dodane</p>";
            }
        } else {

            $error = "<p>login występuje w bazie danych, konto nie zostało dodane</p>";
        }
    } else {

        $error = "<p>Wypełnij wszystkie pola</p>";
    }

?>

<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum o psach</title>
    <link rel="stylesheet" href="styl4.css">
</head>

<body>

    <header>

        <h1>Forum wielbicieli psów</h1>

    </header>



    <section id="main_left">

        <img src="./obraz.jpg" alt="fokstrier">

    </section>



    <section id="main_right1">

        <h2>Zapisz się</h2>

        <form method="post">

            <label for="login">login: </label>
            <input type="text" name="login" id="login">
            <br>
            <label for="password">hasło: </label>
            <input type="text" name="password" id="passwrod">
            <br>
            <label for="password2">powtórz hasło: </label>
            <input type="text" name="password2" id="password2">
            <br>
            <input type="hidden" value="1" name="p1">
            <input type="submit">

        </form>

        <!-- script1 -->
        <?php

        global $error;

        echo $error;

        echo count($_POST);

        ?>

    </section>

    <section id="main_right2">

        <h2>Zapraszamy wszystkich</h2>
        <ol>
            <li>właścicieli psów</li>
            <li>weterynarzy</li>
            <li>tych, co chcą kupić psa</li>
            <li>tych, co lubią psy</li>
        </ol>

        <a href="./regulamin.php">Przeczytaj regulamin forum</a>



    </section>



    <footer>

        Stronę wykonał: 00000000000

    </footer>

</body>

</html>

<?php $dbConn->close() ?>