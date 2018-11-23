<?php 
session_start();
// // Suppression de la Session
if(isset($_SESSION['espace_admin'] ) ) {
    if(isset($_GET['del'] ) ) {
        unset($_SESSION['espace_admin']);
        header('Location:connection.php');
        exit;
    }
}

require('fonctions.php');

// CONNECTION
if (isset($_POST['connection']) ) {
    $_SESSION['espace_admin']['user'] = Connection($_POST['login'], $_POST['psw'], $dsn, $user_name, $user_psw);
    $_SESSION['espace_admin']['connexion'] = True;
    } 

// AJOUT 
if (isset($_POST['ajout_login'],$_POST['ajout_psw'], $_POST['ajout'], $_POST['ajout_rank'])) {
          
    if($_POST['ajout_login'] != '' && $_POST['ajout_psw'] != '') {
      echo Ajout($_POST['ajout_login'], $_POST['ajout_psw'], $_POST['ajout_rank'],$dsn, $user_name, $user_psw);
    }
  }
// MODIFICATION 
if (isset($_POST['modifier'], $_POST['modification'])) {
        
    $rep = Modifier($_POST['modification'], $_POST['modif_login'], $_POST['modif_psw'],$_POST['ajout_rank'], $dsn, $user_name, $user_psw);
}
// SUPPRESSION
if (isset($_POST['supprimer'],$_POST['suppression'])) {

    $rep = Supprimer($_POST['suppression'],$dsn, $user_name, $user_psw);
  }


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Espace_admin</title>
</head>
<body>
<?php 
    if (  $_SESSION['espace_admin']['connexion'] == True) {
         echo '<h1>   Bonjour ' . $_SESSION['espace_admin']['user'][0]['USE_login'] .' <br> Vous êtes ' .$_SESSION['espace_admin']['user'][0]['ROL_name'] .'  </h1> ';

         if($_SESSION['espace_admin']['user'][0]['AUT_id'] == NULL ) {
             echo 'Tu as le droit de rien faire sur mon site petit =) ';
             echo '<img src="denver-moche.jpg" > ';
         }
   
        if(Show_ajouter($_SESSION['espace_admin']['user'], $dsn, $user_name, $user_psw, $nbr_role) == true) {
            echo Show_ajouter($_SESSION['espace_admin']['user'], $dsn, $user_name, $user_psw, $nbr_role); 
        }
            

        if (Show_modifictaion($_SESSION['espace_admin']['user'], $dsn, $user_name, $user_psw, $nbr_role) == true) {
            $all_user = All_user($dsn,$user_name,$user_psw);
            echo ' <form action="" method="POST">
            <h2> Module de Modification des Membres </h2> ';

            echo Show_all_user_modifier($all_user, $_SESSION['espace_admin']['user'], $dsn, $user_name, $user_psw, $nbr_role);

            echo Show_modifier($_SESSION['espace_admin']['user'], $dsn, $user_name, $user_psw, $nbr_role);

                echo '</form>';
        }
    ?>
    </div>
    <?php
    if (Show_suppression($_SESSION['espace_admin']['user'], $dsn, $user_name, $user_psw, $nbr_role) == true) {
    
            // var_dump($all_user);
        echo ' <form action="" method="POST">
            <h2> Module de Suppression des Membres </h2> ';

    
            
        echo Show_all_user_suppression($all_user, $_SESSION['espace_admin']['user'], $dsn, $user_name, $user_psw, $nbr_role);

        echo ' <br> <button type="submit" name="supprimer">Supprimer un user</button>  
            </form> ';

        if(isset($rep)){
            echo $rep;
        }    

    } 
    
} else {
     echo 'Vous n\'êtes pas connecté'; 
}

        echo ' <br> <br> <a href="?del">Déconnexion</a>'; 

?>

    

</body>


<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    text-align:center;
}
th, td {
    padding: 15px;
}

div {
    border: 1px solid black;
    padding : 15px;
}
</style>


</html>