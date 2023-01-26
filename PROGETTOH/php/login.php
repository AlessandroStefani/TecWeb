<?php
require_once '../php/bootstrap.php';

if(isset($_POST["email"]) && isset($_POST["psw"])) {
    $login_result = $dbh->checkLogin($_POST["email"], $_POST["psw"]);
    if(!$login_result){
        $templateParams["errorelogin"] = "E-mail o password errata";
    }
    else{
        header("location: ../php/home-page.php");
    }
}

require '../html/login-form.php';
?>