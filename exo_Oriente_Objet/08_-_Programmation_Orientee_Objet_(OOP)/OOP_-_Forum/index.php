<?php
session_start();

function Load_Class($class){
    if(file_exists("classes/".$class.".php")){
        require_once("classes/".$class.".php");
    }
}
spl_autoload_register('Load_Class');

if(isset($_GET['del'] ) ) {
    if(isset($_SESSION['forum']['user'] ) ) {
        unset($_SESSION['forum']['user']);
        header('Location:.');
        exit;
    }
}


try {
    $convers_model =new conversationModel();
    $conversations = $convers_model->ReadAll();

    if (isset($_SESSION['forum']['user'])) {
        $user = unserialize($_SESSION['forum']['user']);
    }
    // login de la BDD : In@mus.com
    if(isset($_POST['login']) ){
        if (empty($POST['login'])) {
            $login_empty= '<p style="background-color:#ff0000"> Veuillez saisir un login </p>';
        } else {
            $user_model = new userModel(); 
            $user = $user_model->connect($_POST['login']); // Connection bon et reception de L'objet USER 
            // var_dump($user);
            $_SESSION['forum']['user'] = serialize($user);
            // var_dump($user);
        }
    }
    
} catch (Exception $e) {
        header('Location: 404.php');
        exit;
}



?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="main.css">
        <title>BDD Forum</title>
    </head>
    <body>
        <h1> Exercice BDD sur un Forum </h1>
    <?php
         if(isset($_SESSION['forum']['user'])){
            echo '  <div style=" float:right">  
                    <img src="assets/img/avatar.jpg" alt="">
                    <h3> Bonkour '.$user->get_prenom() .' ' .$user->get_nom().' </h3> 
                    <a href="?del" style=" float:right"> <button type="submit"> Déconnexion </button>  </a>
                    </div>';

        } else {
            echo '  <div style=" float:right"> 
                    <img src="assets/img/avatar.jpg" alt="">
                    <h3 style ="text-align:right"> se connecter </a></h3>';
            echo'   <form action="" method="post">';

            if(isset($login_empty)) {
                echo $login_empty;
            }
            echo'   <input type="text" name="login" placeholder="Veuillez saisir votre Tugudu" >
                    <button type="submit" style="display:block"> Se Connecter</button>
                    </form>';
            echo'   <h3 style ="text-align:right"><br> 
                    <p> Vous n\'avez pas de compte ? </p>
                    <a href="createaccount.php"> <button> créer un compte </button></a> 
                    </h3> </div>'; ; 
        }
    ?>
    <section>
            <table>
                <thead >
                <tr>
                    <td>ID de la conversation </td>
                    <td>Date de la conversation</td>
                    <td>Heure de la conversation</td>
                    <td>Nombres de messages</td>
                    <td><?php ?></td>
                </tr>
                </thead>
                <tbody>
                <?php 
                // var_dump($conversations);
                if(isset($conversations)){
                    foreach ($conversations as $key => $value) {                     
                        if($value->get_termine()==0){ 
                            echo'<tr class="opened">'; 
                        }else{ 
                            echo'<tr class="closed">';
                        }
                        echo '<td>'.$value->get_id().'</td>';
                        echo '<td>'.$value->get_date().'</td>';
                        echo '<td>'.$value->get_time().'</td>';
                        echo '<td>'.$value->get_numbers().'</td>';
                        echo '<td>
                        <a href="listingconversation.php?id='.$value->get_id().'&page=1"> Afficher la conversation </a>
                            </td>';
                        echo '</tr>';
                    } 
                }
            
            ?>
                </tbody>
            </table>
        </section>
    </body>
</html>