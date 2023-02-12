<?php
require_once '../php/bootstrap.php';

$templateParams["info-film-seguiti"] = array();
$templateParams["info-serietv-seguite"] = array();
$templateParams["info-anime-seguiti"] = array();
$templateParams["tempo-totale"] = 0;
$templateParams["episodi-totali"] = 0;

$tabellaContenutiSeguiti = $dbh->getFollowedContent($_SESSION["idutente"]);
$filmSeguiti = array();
$serieTvSeguite = array();
$animeSeguiti = array();

foreach ($tabellaContenutiSeguiti as $contenuto) {
    if ($contenuto["idfilm"] != NULL) {
        $filmSeguiti[] = ["idfilm" => $contenuto["idfilm"], "notifiche" => $contenuto["notifiche"]];
    } else if ($contenuto["idserietv"] != NULL) {
        $serieTvSeguite[] = ["idserietv" => $contenuto["idserietv"], "notifiche" => $contenuto["notifiche"]];
    } else if ($contenuto["idanime"] != NULL) {
        $animeSeguiti[] = ["idanime" => $contenuto["idanime"], "notifiche" => $contenuto["notifiche"]];
    }
}

foreach ($filmSeguiti as $film) {
    if ($film["notifiche"]) {
        $templateParams["info-film-seguiti"][] = $dbh->getFilmInfoByID($film["idfilm"])[0] + ["notifiche" => $film["notifiche"]] + ["numero-notifiche" => count($dbh->getFilmPostsPublishedAfter($dbh->getLastFilmPostRead($film["idfilm"])[0]["data"], $film["idfilm"]))];                              
    } else {
        $templateParams["info-film-seguiti"][] = $dbh->getFilmInfoByID($film["idfilm"])[0] + ["notifiche" => $film["notifiche"]];
    }
    $templateParams["episodi-totali"] += 1;
    $templateParams["tempo-totale"] += end($templateParams["info-film-seguiti"])["durata"];
}
 
foreach ($serieTvSeguite as $serieTv) {
    if ($serieTv["notifiche"]) {
        $templateParams["info-serietv-seguite"][] = $dbh->getSerieTvInfoByID($serieTv["idserietv"])[0] + ["notifiche" => $serieTv["notifiche"]] + ["numero-notifiche" => count($dbh->getSerieTvPostsPublishedAfter($dbh->getLastSerieTvPostRead($serieTv["idserietv"])[0]["data"], $serieTv["idserietv"]))];                              
    } else {
        $templateParams["info-serietv-seguite"][] = $dbh->getSerieTvInfoByID($serieTv["idserietv"])[0] + ["notifiche" => $serieTv["notifiche"]];
    }
    $templateParams["episodi-totali"] += end($templateParams["info-serietv-seguite"])["episodi"];
    $templateParams["tempo-totale"] += end($templateParams["info-serietv-seguite"])["durata episodi"] * end($templateParams["info-serietv-seguite"])["episodi"];
}

foreach ($animeSeguiti as $anime) {
    if ($anime["notifiche"]) {
        $templateParams["info-anime-seguiti"][] = $dbh->getAnimeInfoByID($anime["idanime"])[0] + ["notifiche" => $anime["notifiche"]] + ["numero-notifiche" => count($dbh->getAnimePostsPublishedAfter($dbh->getLastAnimePostRead($anime["idanime"])[0]["data"], $anime["idanime"]))];                              
    } else {
        $templateParams["info-anime-seguiti"][] = $dbh->getAnimeInfoByID($anime["idanime"])[0] + ["notifiche" => $anime["notifiche"]];
    }
    $templateParams["episodi-totali"] += end($templateParams["info-anime-seguiti"])["episodi"];
    $templateParams["tempo-totale"] += end($templateParams["info-anime-seguiti"])["durata episodi"] * end($templateParams["info-anime-seguiti"])["episodi"];
}




require '../html/home.php';
?>