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
    
    public function getUserInfobyID($id){
        $query = "SELECT idutente, email, username, `foto profilo` FROM utente WHERE idutente = ?";
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

    public function removeFollowedFilm($idutente, $idfilm){
        $query = "DELETE FROM content_seguito WHERE idutente = ? AND idfilm = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idutente, $idfilm);

        return $stmt->execute();
    }

    public function addFollowedSerieTv($idutente, $idserietv){
        $query = "INSERT INTO content_seguito (idutente, idserietv) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idutente, $idserietv);

        return $stmt->execute();        
    }

    public function removeFollowedSerieTv($idutente, $idserietv){
        $query = "DELETE FROM content_seguito WHERE idutente = ? AND idserietv = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idutente, $idserietv);

        return $stmt->execute();
    }

    public function addFollowedAnime($idutente, $idanime){
        $query = "INSERT INTO content_seguito (idutente, idanime) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idutente, $idanime);

        return $stmt->execute();        
    }

    public function removeFollowedAnime($idutente, $idanime){
        $query = "DELETE FROM content_seguito WHERE idutente = ? AND idanime = ?";
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
    
    public function getPostAnimebyID($id){
        $query = "SELECT u.username, u.`foto profilo`, p.testo, p.immagine, p.data FROM ((( utente u JOIN post p ON u.idutente = p.autore) JOIN post_associati ps ON p.idpost=ps.idpost) JOIN anime a ON ps.idanime = a.idanime) WHERE a.idanime = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    
    public function getPostFilmbyID($id){
        $query = "SELECT u.username, u.`foto profilo`, p.testo, p.immagine, p.data FROM ((( utente u JOIN post p ON u.idutente = p.autore) JOIN post_associati ps ON p.idpost=ps.idpost) JOIN film f ON ps.idfilm = f.idfilm) WHERE f.idfilm = ?";
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
    
    public function getUserPosts($userid){
        $query = "SELECT testo, data, immagine FROM post WHERE autore = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $userid);
        $stmt->execute(); 
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getPostAssociati(){
        $query = "SELECT * FROM post_associati";
        $stmt = $this->db->prepare($query);
        $stmt->execute(); 
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getPostByID($id){
        $query = "SELECT testo, data, immagine, autore FROM post WHERE idpost = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute(); 
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function deletePostByID($id){
        $query = "DELETE FROM post_associati WHERE idpost = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute(); 
        $query = "DELETE FROM post WHERE idpost = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute(); 
    }

    public function getFollowersByID($id){
        $query = "SELECT u.idutente, u.username FROM utente u, utente_seguito us WHERE u.idutente = us.idutente AND us.idutenteseguito = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute(); 
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getFollowedByID($id){
        $query = "SELECT u.idutente, u.username FROM utente_seguito us, utente u  WHERE us.idutenteseguito = u.idutente AND us.idutente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute(); 
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function addFollowByUserID($userid ,$followerid){
        $query = "INSERT INTO utente_seguito (idutente, idutenteseguito) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $userid, $followerid);
        $stmt->execute(); 
    }
    public function removeFollowByUserID($userid ,$followerid){
        $query = "DELETE FROM utente_seguito WHERE idutente = ? AND idutenteseguito = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $userid, $followerid);
        $stmt->execute();
    }

    public function getNotificaFilm($userid ,$id){
        $query = "SELECT notifiche FROM content_seguito WHERE idutente = ? AND idfilm = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $userid, $id);
        $stmt->execute(); 
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getNotificaSerietv($userid ,$id){
        $query = "SELECT notifiche FROM content_seguito WHERE idutente = ? AND idserietv = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $userid, $id);
        $stmt->execute(); 
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getNotificaAnime($userid ,$id){
        $query = "SELECT notifiche FROM content_seguito WHERE idutente = ? AND idanime = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $userid, $id);
        $stmt->execute(); 
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getLastFilmPostRead($idutente, $idfilm) {
        $query = "SELECT * FROM ultimo_post_letto WHERE idutente = ? AND idfilm = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idutente, $idfilm);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFilmPostsPublishedAfter($datapost, $idfilm) {
        $query = "SELECT * FROM vista_post WHERE data > ? AND idfilm = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $datapost, $idfilm);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getLastSerieTvPostRead($idutente, $idserietv) {
        $query = "SELECT * FROM ultimo_post_letto WHERE idutente = ? AND idserietv = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idutente, $idserietv);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSerieTvPostsPublishedAfter($datapost, $idserietv) {
        $query = "SELECT * FROM vista_post WHERE data > ? AND idserietv = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $datapost, $idserietv);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getLastAnimePostRead($idutente, $idanime) {
        $query = "SELECT * FROM ultimo_post_letto WHERE idutente = ? AND idanime = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idutente, $idanime);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAnimePostsPublishedAfter($datapost, $idanime) {
        $query = "SELECT * FROM vista_post WHERE data > ? AND idanime = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $datapost, $idanime);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Add notifiche.
    public function addNotificaFilm($userid, $idfilm){
        $query = "INSERT INTO content_seguito (idutente, idfilm, idserietv, idanime, notifiche) VALUES (?, ?, NULL, NULL, 1)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $userid, $idfilm);
        $stmt->execute(); 
    }
    public function addNotificaSerietv($userid ,$idserietv){
        $query = "INSERT INTO content_seguito (idutente, idfilm, idserietv, idanime, notifiche) VALUES (?, NULL, ?, NULL, 1)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $userid, $idserietv);
        $stmt->execute(); 
    }
    public function addNotificaAnime($userid ,$idanime){
        $query = "INSERT INTO content_seguito (idutente, idfilm, idserietv, idanime, notifiche) VALUES (?, NULL, NULL, ?, 1)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $userid, $idanime);
        $stmt->execute(); 
    }
    // Change notifiche.
    public function ChangeNotificaFilm($userid ,$idfilm, $flagnotifica){
        $query = "UPDATE content_seguito SET notifiche = ? WHERE idutente = ? AND idfilm = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $flagnotifica, $userid, $idfilm);
        $stmt->execute(); 
    }
    public function ChangeNotificaSerietv($userid ,$idserietv, $flagnotifica){
        $query = "UPDATE content_seguito SET notifiche = ? WHERE idutente = ? AND idserietv = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $flagnotifica, $userid, $idserietv);
        $stmt->execute(); 
    }
    public function ChangeNotificaAnime($userid ,$idanime, $flagnotifica){
        $query = "SELECT notifiche FROM content_seguito WHERE idutente = ? AND idanime = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $flagnotifica, $userid, $idanime);
        $stmt->execute(); 
    }
}

?>