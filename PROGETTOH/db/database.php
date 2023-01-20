<?php

class DbHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: ".$db->connect_error);
        }
    }

    public function registerUser($username, $email, $password){
        $safepword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO utente (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $username, $email, $safepword);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function checkLogin($username, $email, $password){
        $query = "SELECT idutente, username, email FROM utente WHERE s";
    }
}

?>