<?php

session_start();

function getCo(){
    $connexion = mysqli_connect("localhost", "root", "", "reservationsalles");
    return $connexion;
}

function redirect(string $url){
    header("Location: ". $url);
    die();
}

function isLoged(){
    $isLoged = !empty($_SESSION["login"]);
    return $isLoged;
}

function extractSafeFromPost(string $name){
    return extractSafe(INPUT_POST, $name);
}
function extractSafe($input, $name){
    return filter_input($input, $name, FILTER_SANITIZE_SPECIAL_CHARS);
}

?>