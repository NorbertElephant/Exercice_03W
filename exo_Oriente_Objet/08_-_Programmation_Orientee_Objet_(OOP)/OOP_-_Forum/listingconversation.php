<?php
session_start();
function Load_Class($class){
    if(file_exists("classes/".$class.".php")){
        require_once("classes/".$class.".php");
    }
}
function pagination($nbr_page){
    $str='';
    for ($i=1; $i <= $nbr_page-1; $i++) { 
        $str .= '<a href="listingconversation.php?id='.$_GET['id'].'&page='.$i.'"> '.$i.'</a>';
   }
   return $str;
}

if(isset($_GET['del'] ) ) {
    if(isset($_SESSION['forum']['user'] ) ) {
        unset($_SESSION['forum']['user']);
        header('Location:index.php');
        exit;
    }
}


spl_autoload_register('Load_Class');

try {
    $message_model = new messageModel();
  
    $valid_id = $message_model->is_exist_id($_GET['id']);
    


    if($valid_id === false) {
            header('Location: 404.php');
            exit;
    }else {
        if (isset($_SESSION['forum']['page'])) {
            if ($_GET['page'] >  ($_SESSION['forum']['page'] -1 )) {
                header('Location: 404.php');
                exit;
            }
        }
        if (isset($_SESSION['forum']['user'])) {
            $user = unserialize($_SESSION['forum']['user']);
        }
        // login de la BDD : In@mus.com
        if(isset($_POST['login'])){
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
            if(isset($user,$_POST['contenu'])){
            
                if(!empty($_POST['contenu'])) {
                    $message_create = $message_model->CreateMessage($_POST['contenu'],date('Y-m-d H:m:s'),$user->get_id(),$_GET['id']);
                    
                }
            }
        

    
        if (isset($_POST['Tri'])) {
            $messages = $message_model->Read($_GET['id'],$_GET['page'],$_POST['Tri']);
        } else{
            $messages = $message_model->Read($_GET['id'],$_GET['page']);
        }

      
         
        // var_dump($messages);
        $nbr_page = $messages[0]->get_numbers()/20;
        $_SESSION['forum']['page']=$nbr_page;

        

        $affichage_page= pagination($nbr_page);
        
        } 
    
        
    }  catch (Exception $e) {
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

        <section>

            <?php

            if(isset($user)){
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
                echo '<input  style=" float:right" type="text" name="login" placeholder="Veuillez saisir votre Tugudu" > <br> <br>
                        <button  style=" float:right" type="submit" style="display:block"> Se Connecter</button>
                        </form>';
                echo'   <h3 style ="text-align:right"><br> 
                        <p> Vous n\'avez pas de compte ? </p>
                        <a href="createaccount.php"> <button> créer un compte </button></a> 
                        </h3> </div>'; 
            }
        
            if(!empty($_GET['id'])) {
                 echo '<a href="index.php"> Revenir en arrière </a>
                <h2> Voici les messages de la conversation : </h2>  ';

                if(isset($message_create)){
                    echo $message_create;
                }
                if (count($messages) > 0) {

                  
            ?> 
            <form action=""  method="POST">
                <span> Tier par : <span> 
                <select name="Tri" id="">
                    <option value="date">Date</option>
                    <option value="id">ID message</option>
                    <option value="nom">Auteur</option>
                </select>
                <button type="submit"> Valider </button>
                <br><br>
            </form>

            <?php 
               if ($_GET['page'] == 1) {
                echo 'Pages : '.$affichage_page.'<a href="listingconversation.php?id='.$_GET['id'].'&page='.($_GET['page']+1).'"> Suivant</a> ';
            }else {
                if ($_GET['page'] > 1  && $_GET['page'] < ($nbr_page-2)) {
                    echo 'Pages :<a href="listingconversation.php?id='.$_GET['id'].'&page='.($_GET['page']-1).'"> Précedent</a>'.$affichage_page.'<a href="listingconversation.php?id='.$_GET['id'].'&page='.($_GET['page']+1).'"> Suivant</a> ';
                }else{
                    echo 'Pages :<a href="listingconversation.php?id='.$_GET['id'].'&page='.($_GET['page']-1).'"> Précedent</a>'.$affichage_page;
                } 
            } 
            
            ?>
                <table>
                    <thead>
                    <tr >
                        <td> Date du message</td>
                        <td> Heure du message </td>
                        <td> Nom Prénom </td>
                        <td> Message </td>
                    </tr>
                    </thead>>
                    <tbody>
                    <?php 
                    // var_dump($conversations);
                    if(isset($messages)){
                        foreach ($messages as $value) {
                            echo '<tr>';
                            echo '<td>'.$value->get_date().'</td>';
                            echo '<td>'.$value->get_time().'</td>';
                            echo '<td>'.$value->get_nom().'</td>';
                            echo '<td>'.$value->get_contenu().'</td>';
                            echo '</tr>';
                        } 
                    }
                ?>
                    </tbody>
                </table>
                <?php
                } else {
                    echo 'Cette conversation est vide pour le moment';
                }


                echo '<div>
                     <h3> Ecricre un message </h3>';
                if(isset($user)) {
                    echo '  <form action="listingconversation.php?id='.$_GET['id'].'&page='.$_GET['page'].'" method="POST">
                                 <textarea style="width:100%" name="contenu" placeholder="Veuillez ecrire le message ici" >
                                 </textarea> <br><br>
                                <input  style="float:right" type="submit" value="Envoyez" > 
                            </form>';
                } else {
                     echo 'Il faut être connecter pour pouvoir écrire un message =) ';
                }
                echo '</div>';

   
            }
