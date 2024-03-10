<?php

class Baza {

    private $mysqli;

    public function __construct($serwer, $user, $pass, $baza) {
        $this->mysqli = new mysqli($serwer, $user, $pass, $baza);
        if ($this->mysqli->connect_errno) {
            printf("Nie udało sie połączenie z serwerem: %s\n",
                    $mysqli->connect_error);
            exit();
        }
        if ($this->mysqli->set_charset("utf8")) {
        }
    }

    function __destruct() {
        $this->mysqli->close();
    }

    public function select($sql, $fields) {
        try {
            $result = $this->mysqli->query($sql);

            if ($result) {
                $data = array(); 

                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }

                $result->close();

                return $data;
            } else {
                throw new Exception("Błąd: " . $this->mysqli->error);
            }
        } catch (Exception $e) {
            return "Bład: " . $e->getMessage();
        }
    }

    public function insert($sql) {
        if ($this->mysqli->query($sql)) {
            echo "Poprawnie dodano do bazy";
            //return true;
        } else {
            echo "Nie dodano do bazy";
            //return false;
        }
    }

    public function delete($sql) {
        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function getMysqli() {
        return $this->mysqli;
    }

    public function selectUser($login, $passwd, $tabela) {
        $id = -1;
        $sql = "SELECT * FROM $tabela WHERE email='$login'";
        if ($result = $this->mysqli->query($sql)) {
            $ile = $result->num_rows;
            if ($ile == 1) {
                $row = $result->fetch_object();
                $hash = $row->passwd;

                if (password_verify($passwd, $hash))
                    $id = $row->id;
            }
        }
        return $id;
    }
}

?>
