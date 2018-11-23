<?php


     /**
     * http://php.net/manual/fr/filter.filters.sanitize.php
     */
    // FILTRER PLUSIEURS VARIABLES 

    $options = array (
        'prenom' => FILTER_SANITIZE_STRING, // Enlever les balises,
        'pseudo' => FILTER_SANITIZE_STRING, // Enlever les balises,
        'email' => FILTER_VALIDATE_EMAIL, // Valider l'adresse de messagerie.
        'age' => array (
            'filter' => FILTER_VALIDATE_INT, // Valider l'entier
            'options' => array (
                'min-rang' => 0 // Minimum 0.
            )
        )
    );
    
    // La variable $result renvoie -> la valeur validée, false si celle-ci ne l'est pas, null si la valeur n'existe pas
    $result = filter_input_array(INPUT_POST, $options);

    /**
     * valeur retournée par filter_input_array() est null si aucune des données voulues (du tableau d'options) n'est présente.
    *  Si c'est le cas, ce ne sera donc pas un tableau contenant que des valeurs null.
     */

    // Le test

    if($result != null) { // Si le formulaire a bien été posté.
        // Enregistrer des messages d'erreur perso.
        $messageErreur = array(
            'email' => 'L\'adresse de messagerie n\'est pas valide.',
            'age' => 'Veuillez entrer un nombre entier positif pour votre âge.'
        );

        $nbrErreurs = 0;

        foreach($options as $cle => $valeur) { // Parcourir tous les champs voulus.
            if(empty($_POST[$cle])) { // Si le champ est vide.
                echo 'Veuillez remplir le champ ' . $cle . '.<br/>';
                $nbrErreurs++;
            }
        }

    }  

    $password = password_hash($POST[password]); // Formulaire validé hasher le mot de passe avant de tout envoyer dans la base donnée.
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Formulaire</title>
</head>
<body>
    <div class="container">
        <h2>Sign Up Now</h2>
        <form method="post">
            <input id="prenom" autocomplete="off" name="prenom" type="text" placeholder="Prénom" required="required" max="20" autofocus="autofocus" />
            <input id="pseudo" autocomplete="off" name="pseudo" type="text" placeholder="Pseudo" required="required" max="20" />
            <input id="age" autocomplete="off" name="age" type="text" placeholder="Âge" required="required" />
            <input id="email" autocomplete="off" name="email" type="email" placeholder="Email" required="required" />
            <input id="password" autocomplete="off" name="password" type="password" placeholder="Mot de passe" required="required" min="8" max="12"/>
            <input id="password-test" autocomplete="off" name="password-test" type="password" placeholder="Mot de passe" required="required" min="8" max="12"/>
            <button class="submit" type="submit"><i class="fa fa-paper-plane" style="font-size:4rem;color:#272F32;"></i></button>
            
        </form>
    </div>
</body>
</html>