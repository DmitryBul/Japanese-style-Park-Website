<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Zakupy
 *
 * @author olive
 */
class Zakupy extends UserManager {

    protected $nazwa;
    protected $ilosc;
    protected $cena;

    public function getNazwa() {
        return $this->nazwa;
    }

    public function setNazwa($nazwa) {
        $this->nazwa = $nazwa;
    }

    public function getIlosc() {
        return $this->ilosc;
    }

    public function setIlosc($ilosc) {
        $this->ilosc = $ilosc;
    }

    public function getCena() {
        return $this->cena;
    }

    public function setCena($cena) {
        $this->cena = $cena;
    }

    function __construct($nazwa, $ilosc, $cena) {
        $this->nazwa = $nazwa;
        $this->ilosc = $ilosc;
        $this->cena = $cena;
    }

    function ZakupyForm() {
        ?>
        <h2>Witamy w sklepie internetowym Yama no Sora!</h2>

        <form action="" method="post">
            <div>
                <label for="towar1"><input type="radio" id="towar1" name="t" value="SHOHIN BONSAI" checked> SHOHIN BONSAI - 120 zł</label>
            </div>

            <div>
                <label for="towar2"><input type="radio" id="towar2" name="t" value="FUKEI BONSAI"> FUKEI BONSAI - 140 zł</label>
            </div>

            <div>
                <label for="towar3"><input type="radio" id="towar3" name="t" value="ISHIGAMI BONSAI"> ISHIGAMI BONSAI - 160 zł</label>
            </div>

            <div>
                <label for="quantity">Ilość:</label>
                <input type="number" id="quantity" name="quantity" min="1" required>
            </div>

            <button type="submit" name="submit1">Zatwierdź zamówienie</button>
        </form>

        <form action="" method="post">
            <div>
                <button type="submit" name="submit2">Zapłać kartą</button>
            </div>

        </form>

        <form action="" method="post">
            <div>
                <button type="submit" name="submit3">Koszyk</button>
            </div>

        </form>

        <form action="" method="post">
            <div>
                <button type="submit" name="submit4">Wyloguj się</button>
            </div>

        </form>
        <form action="" method="post">
            <div>
                <button type="submit" name="submit5">Wyczyść kosz</button>
            </div>

        </form>


        <?php
    }

    public function dane($db, $sessionId) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $selectedProduct = $_POST["t"];
            if ($selectedProduct == "SHOHIN BONSAI") {
                $nazwa = $selectedProduct;
                $cena = 120;
                $ilosc = $_POST["quantity"];
                $cena = $cena * $ilosc;
            } elseif ($selectedProduct == "FUKEI BONSAI") {
                $nazwa = $selectedProduct;
                $cena = 140;
                $ilosc = $_POST["quantity"];
                $cena = $cena * $ilosc;
            } elseif ($selectedProduct == "ISHIGAMI BONSAI") {
                $nazwa = $selectedProduct;
                $cena = 160;
                $ilosc = $_POST["quantity"];
                $cena = $cena * $ilosc;
            } else {
                echo "Nie wybrano żadnego produktu.";
                return false;
            }
        }
        $um = new UserManager();
        $userId = $um->getLoggedInUser($db, $sessionId);
        $sql = "INSERT INTO zakupy (userId, nazwa, ilosc, cena) VALUES ('$userId','$nazwa','$ilosc','$cena');";
        $db->insert($sql);
        return true;
    }

    static public function getKoszFromDB($db, $sessionId, $switcher) {

        $um = new UserManager();
        $userId = $um->getLoggedInUser($db, $sessionId);
        $sql = "SELECT * FROM `zakupy` where userId = $userId";
        $pola = ["nazwa", "ilosc", "cena"];
        $res = $db->select($sql, $pola);
        $cenaALL = 0;
        echo "Twoje zakupy: <br>";
        foreach ($res as $row) {
            echo "Nazwa towaru: " . $row['nazwa'] . ", Ilość: " . $row['ilosc'] . ", Cena: " . $row['cena'] . "<br>";
            $cenaALL += $row['cena'];
        }

        if ($switcher == 1) {
            if (empty($res)) {
                echo "Koszek jest pusty";
                return 0;
            } else {
                return 1;
            }
        }
        echo "Do zapłaty: $cenaALL <br>";
    }
}
?>