<!DOCTYPE html>
<html lang="pl">

    <head>
        <title>Yama no Sora | Ogród japoński</title>
        <link href="css/rejestracja.css" rel="stylesheet" />
    </head>

    <body>
        <?php
        include 'klasy/User.php';
        include_once 'klasy/RegistrationForm.php';
        include_once "klasy/Baza.php";
        $db = new Baza("localhost", "root", "", "clients");
        $regform = new RegistrationForm();
        if (filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
            $user = $regform->checkUser();
            if ($user == NULL) {
                echo '<p>Niepoprawne dane do rejestracji</p>';
            } else {
                echo '<p>Poprawne dane do rejestracji</p>';
                $user->saveDB($db);
                header("location:logowanie.php");
            }
        }
        ?>
    </body>

</html>