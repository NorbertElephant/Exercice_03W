<?php
session_start();
if( isset($_SESSION['story'])) {
    if( isset( $_GET['deconnect'] ) ) {
        unset( $_SESSION['story'] );
        header('Location:index.php');
        exit;
    }
}

include('functions.php');
?> 

                <!-- Algo Principal avec Affichage ! --> 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <title>Le livre dont vous êtes le héro | Le Gungeon de Naheulbeuk </title>
    </head>
    <body>

    <h1 class="text-center">Le livre dont vous êtes le héro | Le Gungeon de Naheulbeuk </h1>
    


    <?php //Histoire 
    
        if(!isset($_SESSION['story']) || (!isset($_POST['choice'])) ) {

            $_SESSION['story']['Chapitre'] = 0; ?>

            <img class="img-thumbnail" width="75%" src='images/début.jpg' alt='DébutDongeon'/> 
    <?php            
            echo Livre(0);

        }

        if(isset($_POST['choice']) && ($_POST['choice'] != 0)){ // relance de l'histoire

            if(ctype_digit( $_POST['choice'])) {

                        $_SESSION['story']['choice']= $_POST['choice'];
                
                        Livre($_SESSION['story']['choice']);
                
            }else {
                echo 'vous avez essayé de tricher ! :/  <br> C\'est pas bien ! <br> 
                <a href="?deconnect">Recommencer une partie</a>';
            }
            
        } elseif( isset($_POST['choice']) && ($_POST['choice'] == 0)){ // arrêt de l'histoire 

            if($_SESSION['story']['Chapitre'] != 0) {
                // Les différents cas possible d'arrêt de l'histoire
                FinPartie($_SESSION['story']['TextChoice']);
                
                }
        }
        //Débug Session
    //  echo '<a href="?deconnect">Déconnexion</a>';

    ?>
       
    </body>
</html>

