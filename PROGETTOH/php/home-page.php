<?php
require_once '../php/bootstrap.php';

$templateParams["contenuti seguiti"] = $dbh->getFollowedContent($_SESSION["idutente"]);
$templateParams["film seguiti"] = array();
$templateParams["serietv seguite"] = array();
$templateParams["anime seguiti"] = array();

foreach ($templateParams["contenuti seguiti"] as $contenuto) {
    if ($contenuto["idfilm"] != NULL) {
        $templateParams["film seguiti"] = $contenuto["idfilm"];
    } else if ($contenuto["idserietv"] != NULL) {
        $templateParams["serietv seguite"] = $contenuto["idserietv"];
    } else if ($contenuto["idanime"] != NULL) {
        $templateParams["anime seguiti"] = $contenuto["idanime"];
    }
}

echo("CONTENUTI: "); var_dump($templateParams["contenuti seguiti"]);
echo("\n FILM: "); var_dump($templateParams["film seguiti"]);
echo("\n SERIE: "); var_dump($templateParams["serietv seguite"]);
echo("\n ANIME: "); var_dump($templateParams["anime seguiti"]);

require '../html/home.php';
?>