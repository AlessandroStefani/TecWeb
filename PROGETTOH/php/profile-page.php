<?php
require_once '../php/bootstrap.php';

$templateParams["postFilm"] = array();
$templateParams["postSerietv"] = array();
$templateParams["postAnime"] = array();
$templateParams["userID"] = 0;

if(isset($_SESSION["notifica_follow"])) {
    unset($_SESSION["notifica_follow"]);
    $dbh->deleteUserFollow($_SESSION["idutente"]);
}

if(isset($_GET["idutente"])){
    $templateParams["UserInfo"] = $dbh->getUserInfobyID($_GET["idutente"])[0];
    $templateParams["UserPosts"] = $dbh->getUserPosts($_GET["idutente"]);
    $templateParams["userID"] = $_GET["idutente"];
} else {
    $templateParams["UserInfo"] = $dbh->getUserInfobyID($_SESSION["idutente"])[0];
    $templateParams["UserPosts"] = $dbh->getUserPosts($_SESSION["idutente"]);    
    $templateParams["userID"] = $_SESSION["idutente"];
}

if(isset($_POST["deleteOrder"]) && isset($_POST["idPost"])){
    $dbh->deletePostByID($_POST["idPost"]);
}

if(isset($_POST["logout"])){
    unset($_SESSION["idutente"]);
    unset($_SESSION["username"]);
    unset($_SESSION["email"]);
    header("location: ../php/login.php");
}

foreach($dbh->getPostAssociati() as $associazionePost){
    if($associazionePost["idfilm"] != NULL && $dbh->getPostByID($associazionePost["idpost"])[0]["autore"] == $templateParams["userID"]){
        $notificaFilm = $dbh->getNotificaFilm($templateParams["userID"], $associazionePost["idfilm"]);
        if (!empty($notificaFilm)) {
            $templateParams["postFilm"][] = ["post" => $dbh->getPostByID($associazionePost["idpost"]), "id" => $associazionePost["idfilm"], "nome" => $dbh->getFilmInfoByID($associazionePost["idfilm"])[0]["nome"], "tipo" => "film", "notifiche" => $notificaFilm[0]["notifiche"]];
        } else {
            $templateParams["postFilm"][] = ["post" => $dbh->getPostByID($associazionePost["idpost"]), "id" => $associazionePost["idfilm"], "nome" => $dbh->getFilmInfoByID($associazionePost["idfilm"])[0]["nome"], "tipo" => "film", "notifiche" => 0];
        }
    } else {
        if($associazionePost["idserietv"] != NULL && $dbh->getPostByID($associazionePost["idpost"])[0]["autore"] == $templateParams["userID"]){
            $notificaSerie = $dbh->getNotificaSerietv($templateParams["userID"], $associazionePost["idserietv"]);
            if(!empty($notificaSerie)) {
                $templateParams["postSerietv"][] = ["post" => $dbh->getPostByID($associazionePost["idpost"]), "id" => $associazionePost["idserietv"], "nome" => $dbh->getSerieTvInfoByID($associazionePost["idserietv"])[0]["nome"], "tipo" => "serietv", "notifiche" => $notificaSerie[0]["notifiche"]];
            } else {
                $templateParams["postSerietv"][] = ["post" => $dbh->getPostByID($associazionePost["idpost"]), "id" => $associazionePost["idserietv"], "nome" => $dbh->getSerieTvInfoByID($associazionePost["idserietv"])[0]["nome"], "tipo" => "serietv", "notifiche" => 0];
            }
        } else {
            if($associazionePost["idanime"] != NULL && $dbh->getPostByID($associazionePost["idpost"])[0]["autore"] == $templateParams["userID"]){
                $notificaAnime = $dbh->getNotificaAnime($templateParams["userID"], $associazionePost["idanime"]);
                if(!empty($notificaAnime)) {
                    $templateParams["postAnime"][] = ["post" => $dbh->getPostByID($associazionePost["idpost"]), "id" => $associazionePost["idanime"], "nome" => $dbh->getAnimeInfoByID($associazionePost["idanime"])[0]["nome"], "tipo" => "anime", "notifiche" => $notificaAnime[0]["notifiche"]];
                } else {
                    $templateParams["postAnime"][] = ["post" => $dbh->getPostByID($associazionePost["idpost"]), "id" => $associazionePost["idanime"], "nome" => $dbh->getAnimeInfoByID($associazionePost["idanime"])[0]["nome"], "tipo" => "anime", "notifiche" => 0];
                }
            }
        }
    }
}

if($dbh->getFollowersByID($templateParams["userID"])){
    $templateParams["Followers"] = $dbh->getFollowersByID($templateParams["userID"]);
}
if($dbh->getFollowedByID($templateParams["userID"])){
    $templateParams["Followed"] = $dbh->getFollowedByID($templateParams["userID"]);
}

if(isset($_POST["follow"]) && $_POST["follow"] && isset($_GET["idutente"]) && $_GET["idutente"]){
    $dbh->addFollowByUserID($_SESSION["idutente"], $_GET["idutente"]);
    $dbh->addUserFollow($_GET["idutente"]);
}

if( isset($_POST["unfollow"]) && $_POST["unfollow"] && isset($_GET["idutente"]) && $_GET["idutente"]){
    $dbh->removeFollowByUserID($_SESSION["idutente"], $_GET["idutente"]);
    $dbh->deleteUserFollow($_GET["idutente"]);
}

require '../html/profile-form.php';
?>