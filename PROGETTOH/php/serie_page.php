<?php 
require_once '../php/bootstrap.php';

$templateParams["titolo"] = $dbh->getSerieInfoByID(1)['nome'];
$templateParams["serieInfo"] = $dbh->getSerieInfoByID(1);
$templateParams["postSerie"] = $dbh->getPostSeriebyID(1);

require '../html/Seriepage-form.php';
?>