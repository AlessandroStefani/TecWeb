<?php
require_once '../php/bootstrap.php';

if (isset($_GET["idfilm"])) {
    if ($_GET["action"]) {
        $dbh->addFollowedFilm($_SESSION["idutente"], $_GET["idfilm"]);
        return;
    }
    $dbh->removeFollowedFilm($_SESSION["idutente"], $_GET["idfilm"]);
} elseif (isset($_GET["idanime"])) {
    if ($_GET["action"]) {
        $dbh->addFollowedAnime($_SESSION["idutente"], $_GET["idanime"]);
        return;
    }
    $dbh->removeFollowedAnime($_SESSION["idutente"], $_GET["idanime"]);
} else {
    if ($_GET["action"]) {
        $dbh->addFollowedSerieTv($_SESSION["idutente"], $_GET["idserietv"]);
        return;
    }
    $dbh->removeFollowedSerieTv($_SESSION["idutente"], $_GET["idserietv"]);
}


?>