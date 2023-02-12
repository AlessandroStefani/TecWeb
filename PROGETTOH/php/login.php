<?php
require_once '../php/bootstrap.php';

$attesa = 30;

if (isset($_SESSION["locked"])) {
	$difference = time() - $_SESSION["locked"];
	$templateParams["errorelogin"] = "Attendere " . ($attesa - $difference) . " secondi";
	if ($difference > $attesa) {
        $templateParams["errorelogin"] = "";
		unset($_SESSION["locked"]);
		unset($_SESSION["errori"]);
	}
} elseif (isset($_SESSION["errori"]) && $_SESSION["errori"] > 2) {
	$_SESSION["locked"] = time();
	$templateParams["errorelogin"] = "Attendere $attesa secondi";
} elseif (isset($_POST["email"]) && isset($_POST["psw"])) {
    $login_result = $dbh->checkLogin($_POST["email"], $_POST["psw"]);
    if(!$login_result){
        $templateParams["errorelogin"] = "E-mail o password errata";
        if (!isset($_SESSION["errori"])) $_SESSION["errori"] = 0;
        $_SESSION["errori"] += 1;
    } else {
        unset($_SESSION["errori"]);
        header("location: ../php/home-page.php");
    }
}

require '../html/login-form.php';
?>