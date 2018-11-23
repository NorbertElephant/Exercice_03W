<?php 
function Load_Class($class){
    if(file_exists("classes/".$class.".php")){
        require_once("classes/".$class.".php");
    }
}

spl_autoload_register('Load_Class');

$user_model = new userModel(); 


if(isset($_POST['login'])){
    $create_account = $user_model->CreateAccount($_POST['login'], $_POST['prenom'], $_POST['nom'], $_POST['date'], date('Y-m-d h:m:s') );
}

?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="main.css">
        <title>Page de Creation de compte</title>
    </head>
    <body>
        <h1> Page d'inscription au Forum des Tugudu ! </h1>
        <section>
       <br> <br><a href="index.php"> Retourner à la page d\'accueil </a>
        <?php 
            if(!isset($_POST['login'])) {
            ?><div style="width: 50%; margin: auto;">
                <h2> Formulaire d'inscription : </h2>
                <form method='POST'> 
                    <span>Login* : </span>
                    <input type="text" name="login" id="" placeholder='Veuillez saisir votre Login'>
                    <br>
                    <span>Prénom : </span>
                    <input type="text" name="prenom" id=""placeholder='Veuillez saisir votre prenom'>
                    <br>
                    <span>Nom : </span>
                    <input type="text" name="nom" id=""placeholder='Veuillez saisir votre Nom'>
                    <br>
                    <span>Votre Date de Naissance* : </span>
                    <input type="date" name="date" id="">
                    <br>
                    <input type="submit" value="Créer"> 
                    <span style="color:rgba(0,0,0,0.2"> * Sont des champs obligatoires <span>  
                </form>
            </div>
            <?php } else {
                if(isset($create_account)){
                    echo $create_account; 
                }
            } ?>
        </section>
    </body>
</html>