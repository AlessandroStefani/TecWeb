<?php

function isUserLoggedIn(){
    return !empty($_SESSION[`idutente`]);
}

function registerLoggedUser($user){
    $_SESSION["idutente"] = $user["idutente"];
    $_SESSION["username"] = $user["username"];
}

?>