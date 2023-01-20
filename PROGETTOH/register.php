<?php
require_once 'bootstrap.php';

if(isset($_POST["uname"]) && isset($_POST["email"]) && isset($_POST["psw"]) && isset($_POST["cpsw"])) {
    if($_POST["psw"] != $_POST["cpsw"]){
        $templateParams["erroreRegistrazione"] = "Le password non corrispondono";
        return;
    } else {
        $access_result = $dbh->registerUser(($_POST["uname"]), isset($_POST["email"]), isset($_POST["psw"]));
    }
}


?>