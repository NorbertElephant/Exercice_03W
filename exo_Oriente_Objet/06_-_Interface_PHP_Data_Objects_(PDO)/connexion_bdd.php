<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="get">
        <input type="text" name="nain" id="">
        <button type="submit">OK</button>
    </form>
</body>
</html>

<?php 
/** Se connecter à une BDD  */

/** DSN : Data Source Name */
$dsn="mysql:host=127.0.0.1;
     dbname=nain_tunnel;
     charset=utf8mb4;";

/**  nom de l'user de la BDD  */
$user_name="root";
/** Mdp du l'user pour la BDD */
$user_psw="";     

if(isset($_GET['nain'])){
    try {
        $db= new PDO($dsn,$user_name,$user_psw,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

        // // Faire une requete  SIMPLE quand il n'y a pas d'entrée du CLIENT
        // $requete = $db->query('SELECT * FROM`nain`');
        // var_dump($requete);

        // // récupérer la réponse d'une requete // 

        // // FETCH récupérer UN seul résultat LIGNE A LIGNE  
        // $reponse = $requete->fetch(PDO::FETCH_ASSOC);
        // var_dump($reponse);

        // // FETCHALL récupérer Un tableau a Deux dimension 
        // $reponse2 = $requete->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($reponse2);


        // Faire une requete  il y a  entrée du CLIENT Avec récup simple 
        if( ($requete = $db->prepare('SELECT * FROM`nain` WHERE `n_nom`=:nom')) !== false )  {
            if ( $requete->bindValue('nom', $_GET['nain']) ) {
                if( $requete->execute() ) {
                    var_dump($requete);
                    while( ($reponse = $requete->fetch(PDO::FETCH_ASSOC) ) !== false ){
                        var_dump($reponse);
                    }
                // FETCHALL récupérer Un tableau a Deux dimension 
                    $reponse2 = $requete->fetchAll(PDO::FETCH_ASSOC);
                    var_dump($reponse2);

                    $requete->closeCursor(); // fermer la BDD
                } else {
                    die('Problème lors de l\'execution');
                } 
            } else {
                die('Problème lors du lien');
            }
        } else {
            die('Problème lors de la preparation');
        }

        // récupérer la réponse d'une requete // 

        // // FETCH récupérer UN seul résultat LIGNE A LIGNE  
        // $reponse = $requete->fetch(PDO::FETCH_ASSOC);
        // var_dump($reponse);

       

        

    } catch( PDOException $e){
        die( $e->getMessage() );
        }
}




?>