<?php 
session_start();
if( isset($_POST['tue'] ) ) {
    unset($_SESSION['MiniJeu']);
}
/**
 * 
 */
Function MiniJeu( $NbreClient, $NbreRand){  

    if ($NbreClient != $NbreRand) {
        if ($NbreClient > $NbreRand ) {
            $resultat = "plus petit ";
            return $resultat;
        }else {
            $resultat = "plus grand ";
            return $resultat;
        }
    }
    $resultat = "Trouvé ! :D ";
    return $resultat;    
}
?> 

<!-- Algo Principale jeu --> 

<?php // Définir le nombre Rand

if (!isset($_SESSION['MiniJeu'])){
   $NbreRand = mt_rand(0,100);
   $_SESSION['MiniJeu']['NbreRand'] = $NbreRand;
}

////////////////
?> 

 <h1> Bonjour, voici un petit jeu !</h1></br>
     Il faut trouver le nombre qui se cache derrière, ce petit est généré de façon aléatoire entre 0 et 100 </br>
    Je vous dirai a chaque fois si votre chiffre est plus petit  ou plus grand que le chiffre Random. </br></br>
    Good Luck. </br> </br> </br> 

<form method="POST"> 
       <input type="text" name="NbreClient" value ="<?php 
        if(isset($_POST['NbreClient'])) {
            if (ctype_digit($_POST['NbreClient'])){
                echo $_POST['NbreClient'];
            }
        }
        ?>"> 
    <input type="Submit" value"Envoyer" />
   
    <?php 
        if(isset($_POST['NbreClient'])) {
            
            if (ctype_digit($_POST['NbreClient'])){

                echo MiniJeu($_POST['NbreClient'],$_SESSION['MiniJeu']['NbreRand']) ;
               
                if ($_POST['NbreClient'] != $_SESSION['MiniJeu']['NbreRand']) {
                   $_SESSION['MiniJeu']['tutu'] = ' Vous avez choisie '. $_POST['NbreClient'] . ' , le nombre a trouver est  ' .  MiniJeu($_POST['NbreClient'],$_SESSION['MiniJeu']['NbreRand'])  ;
                
                }else {
                    $_SESSION['MiniJeu']['tutu'] = 'Bravo Vous avez trouvé le bon nombre ! votre nombre est ' . $_POST['NbreClient'] . ' et le nombre random est bien '. $_SESSION['MiniJeu']['NbreRand'];
                   
                }
            }  
        } else {
            $erreur =" Attention vous n'avez pas rentré un nombre entier ";
            echo $erreur;
        }
     
    ?>
       
    <br>

    <textarea name="historique" cols="70" row='200'>
        <?php 
            if(isset($_SESSION['MiniJeu']['tutu'])){ 
                echo $_SESSION['MiniJeu']['tutu'] . PHP_EOL;
            }
            if( isset( $_POST['historique'] ) ) {
                echo $_POST['historique'];
            } 
        ?>
    </textarea>
       
</form>

<form method="post">
    <input type='submit' name="tue" value='Nouvelle partie' />
</form>
