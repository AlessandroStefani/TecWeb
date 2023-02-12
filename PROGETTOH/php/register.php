<?php
require_once '../php/bootstrap.php';

if(isset($_POST["uname"]) && isset($_POST["email"]) && isset($_POST["psw"]) && isset($_POST["cpsw"])) {
    if($_POST["psw"] != $_POST["cpsw"]){
        $templateParams["erroreRegistrazione"] = "Le password non corrispondono";
    } else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $templateParams["erroreRegistrazione"] = "Email non valida";
    } else {
        if($dbh->registerUser($_POST["uname"], $_POST["email"], $_POST["psw"])){
            header("location: ../html/home.html");
        } else {
            $templateParams["erroreRegistrazione"] = "Email già in uso";            
        }
    }
}

require '../html/register-form.php';
?>