<?php

class RegistrationForm {

    protected $user;

    public function __construct() {
        ?>
        <h3>Rejestracja nowego użytkownika</h3>
        <form action="rejestracja.php" method="post">
            <table>
                <tr>
                    <td>Imie:</td> <td><input name='fullName'></td>
                </tr>
                <tr>
                    <td>Haslo:</td><td> <input name="passwd"></td>
                </tr>
                <tr>
                    <td>Email:</td><td><input name="email"></td> 
                </tr>
                <tr>
                    <td>Telefon:</td> <td><input name="number"></td>
                </tr>
                <tr>
                    <td>Adres:</td> <td><input name="adres"></td>
                </tr>
            </table>
            <br>
            <input type="submit" name="submit" value="Rejestracja">

        </form>
        <<form action="logowanie.php">
            <input type="submit" name="submit" value="Zaloguj się">
        </form>
        <?php
    }

    public function checkUser() {
        $args = [
            'fullName' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^[A-Za-ząęłńśćźżó]{2,}\s[A-Za-ząęłńśćźżó]{2,}/']],
            'passwd' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'email' => FILTER_VALIDATE_EMAIL,
            'number' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^\+48\d{9}$/']],
            'adres' => FILTER_SANITIZE_STRING
        ];
        $dane = filter_input_array(INPUT_POST, $args);

        $errors = "";
        foreach ($dane as $key => $val) {
            if ($val === false or $val === NULL) {
                $errors .= $key . " ";
            }
        }

        if ($errors === "") {
            $this->user = new User($dane['fullName'], $dane['email'], $dane['passwd'], $dane['number'], $dane['adres']);
        } else {
            echo "<p>Niepoprawne dane rejestracji <br>$errors</p>";
            $this->user = NULL;
        }
        return $this->user;
    }
}
