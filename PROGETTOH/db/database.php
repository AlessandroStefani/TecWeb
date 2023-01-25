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

        return $stmt->execute();
    }

    public function checkLogin($email, $password){
        $query = "SELECT idutente, username, email, password FROM utente WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        if(count($result)==0){
            return false;
        }

        if(!password_verify($password, $result[0]["password"])){
            return false;
        }
        registerLoggedUser($result[0]);
        return true;
    }


    public function getSerieInfoByID($id){
        $query = "SELECT * FROM serietv WHERE idserietv = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getPostSeriebyID($id){
        $query = "SELECT u.username AS username, u.foto profilo AS foto, p.testo AS testo, p.immagine AS immagine, p.data AS data FROM ((( utente u JOIN post p ON u.idutente = p.autore) JOIN post_associati ps ON p.postid=ps.idpost) JOIN serietv s ON ps.idserietv = s.idserietv) WHERE idserietv = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getUserInfobyID($id){
        $query = "SELECT username, foto profilo FROM utente WHERE idutente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

}

?>