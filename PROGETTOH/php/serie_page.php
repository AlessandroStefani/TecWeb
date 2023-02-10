<?php 
require_once '../php/bootstrap.php';

$templateParams["titolo"] = $dbh->getSerieTvInfoByID(1)[0]["nome"];
$templateParams["serieInfo"] = $dbh->getSerieTvInfoByID(1)[0];
$templateParams["postSerie"] = $dbh->getPostSeriebyID(1);




require '../html/Seriepage-form.php';
?>