<?php 
require_once("libraries/utilities.php");

require("templates/index.phtml");

if(isset($_GET["destroy"])){
    session_destroy();
    redirect("index.php");
}

unset($_SESSION["cotrue"]);



?>