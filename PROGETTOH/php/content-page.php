<?php
require_once '../php/bootstrap.php';

$templateParams["all-film"] = $dbh->getAllFilm();
$templateParams["all-serietv"] = $dbh->getAllserietv();
$templateParams["all-anime"] = $dbh->getAllAnime();

require '../html/content.php';
?>