<?php

require_once("libraries/utilities.php");

// Je mets ma fonction isLoged dans une variable
$isLoged = isLoged();

// Si aucun utilisateur connecté
if(!$isLoged){
    // Alors je redirige vers l'index
    redirect("index.php");
}

// je stock les elements dans des variables
$login = extractSafeFromPost("login");
$mdp = filter_input(INPUT_POST,"password");
$newMdp = filter_input(INPUT_POST,"newMdp");
$newMdp2 = filter_input(INPUT_POST,"newMdp2");
$hash2 = password_hash($newMdp, PASSWORD_BCRYPT);
$session = $_SESSION["login"];

// Connexion a la base de donnée
$connexion = getCo();
// Je lance une requete qui récupère tout quand login est égale a l'utilisateur connecté
$requete = "SELECT * FROM utilisateurs WHERE login = \"$session\" ";
$query = mysqli_query($connexion, $requete);
$resultat = mysqli_fetch_all($query);
// Si le formulaire a été validé alors je continue
if(isset($_POST["modification"])){
    // Connexion bdd
    $connexion = getCo();
    // Je crée une requete qui compte le nombre de logins dans utilisateurs
    $requete = "SELECT COUNT(login) FROM utilisateurs WHERE login = \"$login\"";
    $query = mysqli_query($connexion, $requete);
    $count = mysqli_fetch_all($query);
    // Si il n'y a pas deja un utilisateur avec ce login dans ma bdd ou si le login entré est égale a la personne connecté je continue
    if($count[0][0]==0||$login==$session){
        // si le mot de passe vérifié a la bdd est bien égale a celui de la bdd et si nouveau mdp est égale au mdp confirmé je continue
        if(password_verify($mdp, $resultat[0][2]) && $newMdp == $newMdp2){
            // Si le nouveau mdp ne contient pas rien
            if($newMdp != ""){
                // Je me connecte
                $connexion = getCo();
                // Je crée une requete qui modifie dans utilisateurs, le mdp, le login, quand l'utilisateur id.
                $requete = "UPDATE utilisateurs SET password =\"$hash2\", login = \"$login\" WHERE utilisateurs.id =".$resultat[0][0]."";
                $query = mysqli_query($connexion, $requete);
                // Je défini le nouveau login a la session
                $session = $login;
                redirect("index.php");
            // Sinon
            }else{   
                // Je me connecte
                $connexion = getCo();
                // Je crée une requete qui modifie dans utilisateurs le login si l'utisateur correspond a l'id
                $requete = "UPDATE utilisateurs SET login = \"$login\" WHERE utilisateurs.id = ".$resultat[0][0]."";
                $query = mysqli_query($connexion, $requete);
                // Je défini le nouveau login a la session
                $session = $login;
                redirect("index.php");
            }
        } else {
            $erreur = "Mot de passe incorrect";
        }
    } else {
        $erreur = "Ce login est déja utilisé";
    }
}

require("templates/profil.phtml");









