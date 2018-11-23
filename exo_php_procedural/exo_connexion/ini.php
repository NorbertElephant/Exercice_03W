<?php 
 


if(!isset($_SESSION['TabLog']['connexion']) ){
    echo '<form method="POST" action="http://localhost/www/exo_bdd/connexion.php">

        <h1> Nom d\'utilisateur </h1>
        <input name="Login" placeholder="Saisissez un produit"  type ="text" >
        
        <h1> Mot de Passe  </h1>
        <input name="PWD" placeholder="Saisissez une quantité"  type ="password" >
        <br> 
        <input name ="add" type="submit">
        
        </form>';
}

?>

