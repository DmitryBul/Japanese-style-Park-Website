<!DOCTYPE html>
<html lang="pl">

    <head>
        <title>Yama no Sora | Ogród japoński</title>
        <link href="css/sklep.css" rel="stylesheet" />
    </head>

    <body>
        <?php
        include_once 'klasy/Baza.php';
        include_once 'klasy/User.php';
        include_once 'klasy/UserManager.php';
        $db = new Baza("localhost", "root", "", "clients");
        $um = new UserManager();
        $um->loginForm();
        if (filter_input(INPUT_POST, "submit")) {
            $userId = $um->login($db);
            if ($userId > 0) {
                header("location:sklepGL.php");
            } else {
                echo "<p>Błędna nazwa użytkownika lub hasło</p>";
            }
        } else {
            
        }
        ?>

    </body>

</html>