<!DOCTYPE html>
<html lang="pl">


    <head>
        <title>Yama no Sora | Ogród japoński</title>
        <link rel="stylesheet" type="text/css" href="css/sklep.css">
    </head>

    <body>
        <?php
        include 'klasy/User.php';
        include_once 'klasy/RegistrationForm.php';
        include_once "klasy/Baza.php";
        include_once "klasy/OplataForm.php";
        include_once "klasy/UserManager.php";
        $db = new Baza("localhost", "root", "", "clients");
        $form = new OplataForm();
        $form->oplataForm();
        session_start();
        $sessionId = session_id();
        $um = new UserManager();
        $userId = $um->getLoggedInUser($db, $sessionId);
        if (isset($_POST["submit"])) {
            $sql = "DELETE from zakupy WHERE userId='$userId';";
            $db->delete($sql);
            header("location:sklepGL.php");
        }
        ?>
    </body>

</html>