<?php 
session_start(); 


// Suppression de la Session
if(isset($_SESSION['espace_admin'] ) ) {
    if(isset($_GET['del'] ) ) {
        unset($_SESSION['espace_admin']);
        header('location:connection.php');
        exit;
    }
}

require('fonctions.php');

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
    <h2> Veuillez vous identifier </h2>

    <form action='espace_administration.php' method="POST">
    <p> Votre login : </p> 
    <input type="text" name="login" id="">
    <p> Votre mot de passe : </p> 
    <input type="password" name="psw" id="">
    <br>
    <button type="submit" name="connection">Valider</button>
     
    <?php 
    if (isset($error)) {
        echo "<br> <br>".$error;
    }

   
    ?> 

    </form>

<?php 

 echo '<a href="?del">Delete Session</a>';
?>

</body>
</html>


