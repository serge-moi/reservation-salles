<?php

require_once("libraries/utilities.php");

// Je mets ma fonction isLoged dans une variable
$isLoged = isLoged();

// Si un utilisateur est connecté
if($isLoged){
    // Alors je redirige vers l'index
    redirect("index.php");
}

// Si le formulaire est validé alors je peux continuer
if(isset($_POST["connexion"])){
$login = extractSafeFromPost("login");
$mdp = filter_input(INPUT_POST,"password");
$hash = password_hash($mdp, PASSWORD_BCRYPT);
    // Si l'utilisateur a rentré un login et un password alors je peux continuer
    if(!empty($login) && !empty($mdp)){
        // Je me connecte a la bdd
        $connexion = getCo();
        $requete = "SELECT * FROM utilisateurs WHERE login =\"$login\"";
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_all($query);
        // Si la variable résultat n'est pas vide alors je peux continuer
        if(!empty($resultat)){
            // Si le mdp entré dans le formulaire est similaire au mdp hashé dans la bdo alors je peux continuer
            if(password_verify($mdp, $resultat[0][2])){
                // Je crée une session pour afficher la confirmation de connexion
                $_SESSION["cotrue"] = "<div id=\"ggco\">Bravo, te voila connecté</div>";
                // Je stock dans une session le login qui vient d'être validé dans le formulaire de connexion et qui sera donc la personne connecté
                $_SESSION["login"] = $login;
                // Je fais de même avec le mdp
                $_SESSION["password"] = $mdp;
                // Je stock l'id
                $_SESSION["id"] = $resultat[0][0];
                // Je redirige vers la page d'accueil une fois la connexion effectuée
                redirect("index.php");


            // Si le mdp entré dans le formulaire n'est pas similaire au mdp hashé, j'affiche un message d'erreur
            } else {
                $erreur = "Mauvais login ou mot de passe";
            }
                

        // Si l'indentifiant entré ne concorde pas avec l'un des identifiants stocké dans la bdo alors j'affiche un message d'erreur
        } else {
            $erreur = "Cet identifiant n'existe pas";
        } 
            

    // Si l'utilisateur n'a pas rentré le login ou le mdp alors j'affiche un message d'erreur
    } else {
        $erreur = "Veuillez remplir tous les champs";
    }
}

require("templates/connexion.phtml"); ?>