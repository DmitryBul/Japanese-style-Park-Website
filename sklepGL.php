<!DOCTYPE html>
<html lang="pl">

    <head>
        <title>Yama no Sora | Ogród japoński</title>
        <link rel="stylesheet" type="text/css" href="css/sklepGL.css">
    </head>

    <body>
        <?php
        include_once 'klasy/Baza.php';
        include_once 'klasy/User.php';
        include_once 'klasy/UserManager.php';
        include_once 'klasy/Zakupy.php';
        $db = new Baza("localhost", "root", "", "clients");

        $um = new UserManager();

        $forma = new Zakupy("", 1, 1);

        session_start();
        $sessionId = session_id();
        $userID = $um->getLoggedInUser($db, $sessionId);

        if ($userID < 0) {
            echo "Brak dostępu";
        } else {
            $forma->ZakupyForm();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['submit1']) || isset($_POST['submit2']) || isset($_POST['submit3']) || isset($_POST['submit4']) || isset($_POST['submit5'])) {
                    if (isset($_POST['submit1'])) {
                        $forma->dane($db, $sessionId);
                        echo '<p>Poprawne dane</p>';
                    } elseif (isset($_POST['submit2'])) {
                        if ($forma->getKoszFromDB($db, $sessionId, 1) == 1) {
                            header("location:oplata.php");
                        } else {
                        }
                    } elseif (isset($_POST['submit3'])) {
                        $forma->getKoszFromDB($db, $sessionId, 0);
                    } elseif (isset($_POST['submit4'])) {
                        $um->logout($db);
                        header("location:logowanie.php");
                    } elseif (isset($_POST['submit5'])){
                        $sql = "DELETE from zakupy WHERE userId='$userID';";
                        $db->delete($sql);
                        header("location:sklepGL.php");
                    }
                } else {
                    
                }
            }
        }
        ?>
    </body>

</html>