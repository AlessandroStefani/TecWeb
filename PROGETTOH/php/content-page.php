<?php
require_once '../php/bootstrap.php';

$templateparams["all film"] = $dbh->getAllFilm();
$templateparams["all serietv"] = $dbh->getAllserietv();
$templateparams["all anime"] = $dbh->getAllAnime();

require '../html/content-page.html';
?>