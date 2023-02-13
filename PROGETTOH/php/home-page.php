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
        $ultimo_post_letto = $dbh->getLastFilmPostRead($_SESSION["idutente"], $film["idfilm"]);
        if (empty($ultimo_post_letto)){
            $templateParams["info-film-seguiti"][] = $dbh->getFilmInfoByID($film["idfilm"])[0] + ["notifiche" => $film["notifiche"]] + ["numero-notifiche" => 0];
        } else {
            $templateParams["info-film-seguiti"][] = $dbh->getFilmInfoByID($film["idfilm"])[0] + ["notifiche" => $film["notifiche"]] + ["numero-notifiche" => count($dbh->getFilmPostsPublishedAfter($ultimo_post_letto[0]["data"], $film["idfilm"]))];
        }
    } else {
        $templateParams["info-film-seguiti"][] = $dbh->getFilmInfoByID($film["idfilm"])[0] + ["notifiche" => $film["notifiche"]];
    }
    $templateParams["episodi-totali"] += 1;
    $templateParams["tempo-totale"] += end($templateParams["info-film-seguiti"])["durata"];
}
 
foreach ($serieTvSeguite as $serieTv) {
    if ($serieTv["notifiche"]) {
        $ultimo_post_letto = $dbh->getLastSerieTvPostRead($_SESSION["idutente"], $serieTv["idserietv"]);
        if (empty($ultimo_post_letto)){
            $templateParams["info-serietv-seguite"][] = $dbh->getSerieTvInfoByID($serieTv["idserietv"])[0] + ["notifiche" => $serieTv["notifiche"]] + ["numero-notifiche" => 0];
        } else {
            $templateParams["info-serietv-seguite"][] = $dbh->getSerieTvInfoByID($serieTv["idserietv"])[0] + ["notifiche" => $serieTv["notifiche"]] + ["numero-notifiche" => count($dbh->getSerieTvPostsPublishedAfter($ultimo_post_letto[0]["data"], $serieTv["idserietv"]))];
        }                          
    } else {
        $templateParams["info-serietv-seguite"][] = $dbh->getSerieTvInfoByID($serieTv["idserietv"])[0] + ["notifiche" => $serieTv["notifiche"]];
    }
    $templateParams["episodi-totali"] += end($templateParams["info-serietv-seguite"])["episodi"];
    $templateParams["tempo-totale"] += end($templateParams["info-serietv-seguite"])["durata episodi"] * end($templateParams["info-serietv-seguite"])["episodi"];
}

foreach ($animeSeguiti as $anime) {
    if ($anime["notifiche"]) {
        $ultimo_post_letto = $dbh->getLastAnimePostRead($_SESSION["idutente"], $anime["idanime"]);        
        if (empty($ultimo_post_letto)){
            $templateParams["info-anime-seguiti"][] = $dbh->getAnimeInfoByID($anime["idanime"])[0] + ["notifiche" => $anime["notifiche"]] + ["numero-notifiche" => 0];
        } else {
            $templateParams["info-anime-seguiti"][] = $dbh->getAnimeInfoByID($anime["idanime"])[0] + ["notifiche" => $anime["notifiche"]] + ["numero-notifiche" => count($dbh->getAnimePostsPublishedAfter($ultimo_post_letto[0]["data"], $anime["idanime"]))];
        }
    } else {
        $templateParams["info-anime-seguiti"][] = $dbh->getAnimeInfoByID($anime["idanime"])[0] + ["notifiche" => $anime["notifiche"]];
    }
    $templateParams["episodi-totali"] += end($templateParams["info-anime-seguiti"])["episodi"];
    $templateParams["tempo-totale"] += end($templateParams["info-anime-seguiti"])["durata episodi"] * end($templateParams["info-anime-seguiti"])["episodi"];
}




require '../html/home.php';
?>