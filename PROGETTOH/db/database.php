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

    public function getFilmInfoByID($id){
        $query = "SELECT * FROM film WHERE idfilm = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getSerieTvInfoByID($id){
        $query = "SELECT * FROM serietv WHERE idserietv = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getAnimeInfoByID($id){
        $query = "SELECT * FROM anime WHERE idanime = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getFollowedContent($idutente){
        $query = "SELECT idfilm, idserietv, idanime, notifiche FROM content_seguito WHERE idutente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idutente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addFollowedFilm($idutente, $idfilm){
        $query = "INSERT INTO content_seguito (idutente, idfilm) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idutente, $idfilm);

        return $stmt->execute();
    }

    public function addFollowedSerieTv($idserietv){
        $query = "INSERT INTO content_seguito (idutente, idserietv) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idutente, $idserietv);

        return $stmt->execute();        
    }

    public function addFollowedAnime($idanime){
        $query = "INSERT INTO content_seguito (idutente, idanime) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idutente, $idanime);

        return $stmt->execute();        
    }

    public function getAllAnime(){
        $query = "SELECT * FROM anime";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllFilm(){
        $query = "SELECT * FROM film";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllserietv(){
        $query = "SELECT * FROM serietv";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getPostSeriebyID($id){
        $query = "SELECT u.username, u.`foto profilo`, p.testo, p.immagine, p.data FROM ((( utente u JOIN post p ON u.idutente = p.autore) JOIN post_associati ps ON p.idpost=ps.idpost) JOIN serietv s ON ps.idserietv = s.idserietv) WHERE s.idserietv = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function insertPost($testoarticolo, $dataarticolo, $imgarticolo, $autore){
        $query = "INSERT INTO post (testo, immagine, autore, data) VALUES ( ?, ?, ?, ? )";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssis', $testoarticolo, $imgarticolo, $autore, $dataarticolo);
        $stmt->execute();
        return $stmt->insert_id;
    }
    public function associaPost($id, $idContet, $contentType) {
        if($contentType == "serietv"){
            $query = "INSERT INTO post_associati (idpost, idfilm, idserietv, idanime) VALUES ( ?, NULL, ?, NULL )";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ii', $id, $idContet);
            $stmt->execute();    
        }
        if($contentType == "film"){
            $query = "INSERT INTO post_associati (idpost, idfilm, idserietv, idanime) VALUES ( ?, ?, NULL, NULL )";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ii', $id, $idContet);
            $stmt->execute();    
        }
        if($contentType == "anime"){
            $query = "INSERT INTO post_associati (idpost, idfilm, idserietv, idanime) VALUES ( ?, NULL, NULL, ? )";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ii', $id, $idContet);
            $stmt->execute();    
        }
    }
}

?>