<?php
require_once '../php/bootstrap.php';

if(isset($_POST["uname"]) && isset($_POST["email"]) && isset($_POST["psw"]) && isset($_POST["cpsw"])) {
    if($_POST["psw"] != $_POST["cpsw"]){
        $templateParams["erroreRegistrazione"] = "Le password non corrispondono";
    } else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $templateParams["erroreRegistrazione"] = "Email non valida";
    } else {
        $idutente = $dbh->registerUser($_POST["uname"], $_POST["email"], $_POST["psw"]);
        echo "$idutente";
        if($idutente){
            registerLoggedUser($dbh->getUserInfobyID($idutente)[0]);
            header("location: ../php/home-page.php");
        } else {
            $templateParams["erroreRegistrazione"] = "Email già in uso";            
        }
    }
}

require '../html/register-form.php';
?>