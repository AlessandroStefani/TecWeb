<?php
session_start();
require_once("../utils/functions.php");
require_once("../db/database.php");
$dbh = new DbHelper("localhost", "root", "", "progweb", 3306);
?>