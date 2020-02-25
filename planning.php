<?php

require_once("libraries/utilities.php");


$connexion = getCo(); 
$requete = "SELECT u.id, u.login,r.id, r.titre, r.description, r.debut, r.fin, r.id_utilisateur FROM utilisateurs AS u INNER JOIN reservations AS r WHERE u.id = r.id_utilisateur AND WEEK(debut) = WEEK(CURDATE())";
$query = mysqli_query($connexion,$requete);
$resultats = mysqli_fetch_all($query);
// var_dump($resultats);


$jours = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];

require("templates/planning.phtml");

unset($_SESSION["evnotco"]);
unset($_SESSION["newresa"]);




 ?>