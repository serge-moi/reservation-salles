<?php

require("libraries/utilities.php");

// Je mets ma fonction isLoged dans une variable
$isLoged = isLoged();

// Si un utilisateur est connecté
if(!$isLoged){
    // Alors je redirige vers l'index
    $_SESSION["evnotco"] = "Vous devez être connecté pour accéder aux évènements";
    redirect("planning.php");
}

$connexion = getCo(); 
$requete = "SELECT * FROM utilisateurs AS u INNER JOIN reservations AS r ON u.id = r.id_utilisateur WHERE r.id = '".$_GET["id"]."'";
$query = mysqli_query($connexion,$requete);
$resultats = mysqli_fetch_assoc($query);

$deb = $resultats["debut"];
$fin = $resultats["fin"];
$debut = date("G", strtotime($deb));
$fini = date("G", strtotime($fin));

require("templates/reservation.phtml");