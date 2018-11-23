<?php 
session_start();

// Suppression de la session 
if(isset($_POST['deco'])){
    unset($_SESSION['login_password']);
    unset($_SESSION['nb_fois']);
}

// compteur de Nb_fois Connexion  // 
if(isset($_SESSION['nb_fois'])) { 
    $_SESSION['nb_fois'] += 1;
} else {
    $_SESSION['nb_fois'] = 0; // Initialisation nb_fois
    $_SESSION['login_password'] = ""; // Initialisation login_password
}

?> 
                            <!-- Affichage de la page --> 
<head> 
    <title> Exercice de Login </title> 
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
</head> 

<body> 
<h2> Veuillez saisir votre login et votre mot de passe </h2>
<h3>  login : Dupont // votre mot de passe : alibaba  </h3>

    <form action="verif_log.php" method="POST">
    
        login : <input type="text" name="login" /> <br><br> 
        Mot de passe : <input type="text" name="password" /> <br><br> 
        <input type="submit" name="envoyer" value="valider" /> <br><br> 

        <?php 
            if (isset($_Get ['message']) && $_Get['message'] == '1' ) { // afficher message erreur
                echo "<span style='color:#ff0000'> login incorrect </span>";
            }
        ?> 
        <br> 
        Vous avez essayé <?php echo  $_SESSION['nb_fois'];?> fois .
        <br> 
        <?php 
            if($_SESSION['login_password'] != "") { ?> 
            Les logins et mot de passe essayés sont : 
                <?php 
                    echo substr($_SESSION['login_password'], 0, strlen($_SESSION['login_password'])-2);    // enlève le dernier espace      
                } ?>         
     </form> 
</body>
</hmtl> 