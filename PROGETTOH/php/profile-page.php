<?php
require_once '../php/bootstrap.php';

$templateParams["postFilm"] = array();
$templateParams["postSerietv"] = array();
$templateParams["postAnime"] = array();
$templateParams["userID"] = 0;

if(isset($_GET["idutente"])){
    $templateParams["UserInfo"] = $dbh->getUserInfobyID($_GET["idutente"])[0];
    $templateParams["UserPosts"] = $dbh->getUserPosts($_GET["idutente"]);
    $templateParams["userID"] = $_GET["idutente"];
} else {
    $templateParams["UserInfo"] = $dbh->getUserInfobyID($_SESSION["idutente"])[0];
    $templateParams["UserPosts"] = $dbh->getUserPosts($_SESSION["idutente"]);    
    $templateParams["userID"] = $_SESSION["idutente"];
}

foreach($dbh->getPostAssociati() as $associazionePost){
    if($associazionePost["idfilm"] != NULL && $dbh->getPostByID($associazionePost["idpost"])[0]["autore"] == $templateParams["userID"]){
        $templateParams["postFilm"][] = ["post" => $dbh->getPostByID($associazionePost["idpost"]), "id" => $associazionePost["idfilm"], "nome" => $dbh->getFilmInfoByID($associazionePost["idfilm"])[0]["nome"], "tipo" => "film", "notifiche" => $dbh->getNotificaFilm($templateParams["userID"], $associazionePost["idfilm"])[0]];
    } else {
        if($associazionePost["idserietv"] != NULL && $dbh->getPostByID($associazionePost["idpost"])[0]["autore"] == $templateParams["userID"]){
            $templateParams["postSerietv"][] = ["post" => $dbh->getPostByID($associazionePost["idpost"]), "id" => $associazionePost["idserietv"], "nome" => $dbh->getSerieTvInfoByID($associazionePost["idserietv"])[0]["nome"], "tipo" => "serietv", "notifiche" => $dbh->getNotificaSerietv($templateParams["userID"], $associazionePost["idserietv"])[0]];
        } else {
            if($associazionePost["idanime"] != NULL && $dbh->getPostByID($associazionePost["idpost"])[0]["autore"] == $templateParams["userID"]){
                $templateParams["postAnime"][] = ["post" => $dbh->getPostByID($associazionePost["idpost"]), "id" => $associazionePost["idanime"], "nome" => $dbh->getAnimeInfoByID($associazionePost["idanime"])[0]["nome"], "tipo" => "anime", "notifiche" => $dbh->getNotificaAnime($templateParams["userID"], $associazionePost["idanime"])[0]];
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
}

if( isset($_POST["unfollow"]) && $_POST["unfollow"] && isset($_GET["idutente"]) && $_GET["idutente"]){
    $dbh->removeFollowByUserID($_SESSION["idutente"], $_GET["idutente"]);
}

require '../html/profile-form.php';
?>