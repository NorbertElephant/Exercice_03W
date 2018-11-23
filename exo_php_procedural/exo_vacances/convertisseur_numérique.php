<?php 
session_start();
// Suppression de la Session
if(isset($_SESSION['Conver'] ) ) {
    if(isset($_GET['del'] ) ) {
        unset($_SESSION['Conver']);
        header('location: convertisseur_numérique.php');
        exit;
    }
}
$Tab_conv =[
    'M' => 1000,
    'D' => 500,
    'C' => 100,
    'L' => 50, 
    'X' => 10,
    'V'=> 5,
    'I'=> 1,
]; 

if(isset($_POST['conver'])){
    if(ctype_digit($_POST['conver'])){
        $Tab_conver = str_split($_POST['conver']);
        echo count($Tab_conver);
    }
       
}





var_dump($Tab_conv);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exo_convertisseur</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" placeholder="Veuillez entrer une date ou un chiffre romain" name="conver">
        <input type="submit" value="Valider"> 
        <?php
             echo ' <br>  <br> <br> <a href="?del">Delete Session</a>';
        ?>
    </form>
</body> 
</html> 