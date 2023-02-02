<?php
require_once '../php/bootstrap.php';

$templateParams["info-film-seguiti"] = array();
$templateParams["info-serietv-seguite"] = array();
$templateParams["info-anime-seguiti"] = array();

$tabellaContenutiSeguiti = $dbh->getFollowedContent($_SESSION["idutente"]);
$filmSeguiti = array();
$serieTvSeguite = array();
$animeSeguiti = array();

foreach ($tabellaContenutiSeguiti as $contenuto) {
    if ($contenuto["idfilm"] != NULL) {
        $filmSeguiti[] = $contenuto["idfilm"];
    } else if ($contenuto["idserietv"] != NULL) {
        $serieTvSeguite[] = $contenuto["idserietv"];
    } else if ($contenuto["idanime"] != NULL) {
        $animeSeguiti[] = $contenuto["idanime"];
    }
}

foreach ($filmSeguiti as $idfilm) {
    $templateParams["info-film-seguiti"][] = $dbh->getFilmInfoByID($idfilm)[0];
}

foreach ($serieTvSeguite as $idserietv) {
    $templateParams["info-serietv-seguite"][] = $dbh->getSerieTvInfoByID($idserietv)[0];
}

foreach ($animeSeguiti as $idanime) {
    $templateParams["info-anime-seguiti"][] = $dbh->getAnimeInfoByID($idanime)[0];
}

require '../html/home.php';
?>