<?php
require_once '../php/bootstrap.php';

$templateParams["contenuti"] =$dbh->getFollowedContent($_SESSION["idutente"]);

require '../html/home.php';
?>