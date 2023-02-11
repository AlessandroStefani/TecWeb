<?php
require_once '../php/bootstrap.php';

$templateParams["all-film"] = $dbh->getAllFilm();
$templateParams["all-serietv"] = $dbh->getAllserietv();
$templateParams["all-anime"] = $dbh->getAllAnime();

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

require '../html/content.php';
?>