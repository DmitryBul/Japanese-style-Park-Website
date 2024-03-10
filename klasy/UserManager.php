<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of UserManager
 *
 * @author olive
 */
class UserManager {

    function loginForm() {
        ?>
        <div class="container">
            <h1>Logowanie</h1>
            <form id="loginForm" action="" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="login" required>
                </div>

                <div class="form-group">
                    <label for="password">Hasło:</label>
                    <input type="password" id="password" name="passwd" required>
                </div>

                <input style="margin-left: 2%;" type="submit" name="submit" value="Zaloguj się">
            </form>
        </div>
        <?php
    }

    function login($db) {
        $args = ['login' => 521, 'passwd' => 521];
        $dane = filter_input_array(INPUT_POST, $args);
        $login = $dane["login"];
        $passwd = $dane["passwd"];
        $userId = $db->selectUser($login, $passwd, "users");
        if ($userId >= 0) {
            $sql = "DELETE from logged_in_users WHERE userId=$userId;";
            $db->delete($sql);
            session_start();
            $session_id = session_id();
            $lastUpdate = new DateTime();
            $lastUpdate = $lastUpdate->format("Y-m-d H:i:s");
            $sql = "INSERT INTO logged_in_users VALUES ('$session_id','$userId','$lastUpdate');";
            $db->insert($sql);
            return $userId;
        } else {
            return -1;
        }
    }

    function getLoggedInUser($db, $sessionId) {
        $tab = ["userId"];
        $userIDArray = $db->select("select userId from logged_in_users where sessionId = '$sessionId'", $tab);
        if (!empty($userIDArray)) {
            return $userIDArray[0]["userId"];
        } else {
            return -1;
        }
    }

    function logout($db) {
        session_start();
        $session_id = session_id();
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 4200, '/');
        }
        session_destroy();

        $sql = "DELETE from logged_in_users WHERE sessionId='$session_id';";
        if ($db->delete($sql)) {
            echo "<h6>Uzytwkonik wylogowany</h6>";
        }
    }
}
