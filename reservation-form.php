<?php

require_once("libraries/utilities.php");

date_default_timezone_set('UTC');

$isLoged = isLoged();

if(!$isLoged){
    redirect("index.php");
}

$guys = $_SESSION["login"];

$title = extractSafeFromPost("titre");
$titleslash = addslashes($title); 
$desc = extractSafeFromPost("description");
$descslash = addslashes($desc);
$debut = filter_input(INPUT_POST,"dateDebut");
$fin = filter_input(INPUT_POST,"dateFin");
$currentDate = date("Y-m-d H:i:s");
$hStrDebut = date("H",  strtotime($debut));
$hStrFin = date("H", strtotime($fin));
$iStrDebut = date("i", strtotime($debut));
$iStrFin = date("i", strtotime($fin));
$sStrDebut = date("s", strtotime($debut));
$sStrFin = date("s", strtotime($fin));

$jSemaine = date("w", strtotime($debut));

$connexion = getCo();
$verifTime = "SELECT id FROM reservations WHERE debut = '".$debut."'";
$queryTime = mysqli_query($connexion, $verifTime);
$resultatTime = mysqli_fetch_assoc($queryTime);
// var_dump($resultatTime);

if(isset($_POST["titre"]) && empty($_POST["titre"]) || isset($_POST["description"]) && empty($_POST["description"]) || isset($_POST["dateDebut"]) && empty($_POST["dateDebut"]) || isset($_POST["dateFin"]) && empty($_POST["dateFin"])){
    $erreur = "Veuillez remplir tous les champs";
} else {
    if(isset($_POST["reservation"])){
        if($debut > $currentDate){
            if($hStrFin - $hStrDebut == 1){
                if($iStrDebut == 0 && $iStrFin == 0 && $sStrDebut == 0 && $sStrFin == 0){  
                    if($hStrDebut >= 8 && $hStrDebut <= 18 && $hStrFin >= 9 && $hStrFin <= 19){
                        if($jSemaine >= 1 && $jSemaine <= 5){
                            if(!empty($resultatTime)){
                                $erreur = "créneau occcupé";
                            } else {
                            $requete = "INSERT INTO `reservations`(`id`, `titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES (null,\"$title\",\"$descslash\",\"$debut\",\"$fin\",'".$_SESSION['id']."')";
                            $query = mysqli_query($connexion,$requete);
                            $_SESSION["newresa"] = "Félications ".$guys. " votre réservation a bien été enregistré";
                            redirect("planning.php");
                            }
                        } else {
                            $erreur = "Vous ne pouvez pas réserver le week end";
                        }
                    } else {
                        $erreur = "Veuillez respecter les créneaux horaires !";
                    }
                } else {
                    $erreur = "Vous devez choisir une horaire pile";
                }
            } else {
                $erreur = "Vous ne pouvez reserver a plus d'une heure d'interval";
            }
        } else {
            $erreur = "Cette date est déjà passé";
        }
    }
}

require("templates/reservation-form.phtml");





