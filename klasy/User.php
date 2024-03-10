<?php

class User {

    const STATUS_USER = 1;
    const STATUS_ADMIN = 2;

    protected $fullName;
    protected $password;
    protected $email;
    protected $date;
    protected $status;
    protected $adres;
    protected $number;

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getFullName() {
        return $this->fullName;
    }

    public function setFullName($fullName) {
        $this->fullName = $fullName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getNumber() {
        return $this->number;
    }

    public function setNumber($number) {
        $this->number = $number;
    }

    public function getAdres() {
        return $this->adres;
    }

    public function setAdres($adres) {
        $this->adres = $adres;
    }

    function __construct($fullName, $email, $password, $number, $adres) {
        $this->fullName = $fullName;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->number = $number;
        $this->adres = $adres;
        $this->status = User::STATUS_USER;
        $this->date = new DateTime();
    }
    
    public function saveDB($db) {
        $sql = "INSERT INTO users (fullName, email, passwd, number, adres, status, date) VALUES ('" . $this->getFullName() . "','" . $this->getEmail() . "','" . $this->getPassword() . "','" . $this->getNumber() . "','" . $this->getAdres() . "','1','" . $this->getDate()->format("Y-m-d") . "');";
        echo $sql;
        $db->insert($sql);
    }
}
