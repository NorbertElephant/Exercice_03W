<?php

if (!isset($_SESSION['espace_admin']['connect']) ){
    $_SESSION['espace_admin']['connect'] = false;
}


/** DSN : Data Source Name */
$dsn="mysql:host=127.0.0.1;
     dbname=espace_admin;
     charset=utf8mb4;";
/**  nom de l'user de la BDD  */
$user_name="root";
/** Mdp du l'user pour la BDD */
$user_psw="";   

// Nombre de Role  --- Je dois faire une fonction !! 
$nbr_role = 3;


/***************************************************************************************************** */
                                            // Functions  CONNECTION // 
/***************************************************************************************************** */


function Connection($login, $psw, $dsn, $user_name, $user_psw) {
    if( isset($login) && $login != '' ) {

        if(isset($psw) && $psw != '' ) {
            try {
                $db= new PDO($dsn,$user_name,$user_psw,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        
                if( ($requete = $db->prepare('SELECT `USER`.`USE_id`,`USER`.`USE_login`, `ROLE`.`ROL_name`,`AUTORISATION`.*
                                            FROM `USER`
                                            LEFT JOIN `ROLE` ON `USER`.`USE_role_fk` = `ROLE`.`ROL_id`
                                            LEFT JOIN `DETIENT` ON `DETIENT`.`DET_role_fk` = `ROLE`.`ROL_id`
                                            LEFT JOIN `AUTORISATION` ON `DETIENT`.`DET_aut_fk` = `AUTORISATION`.`AUT_id`  
                                            WHERE `USE_login`=:nom 
                                            AND `USE_psw`=:psw'))
                    !== false )  {
                    if ( $requete->bindValue('nom',$login) && $requete->bindValue('psw', $psw) ) {
                        if( $requete->execute() ) {
                            // var_dump($requete);
                            if ( ($user = $requete->fetchAll(PDO::FETCH_ASSOC))  !== false ){

                                return $user;
                                $requete->closeCursor(); // fermer la BDD
                            }die('Problème lors récup données');
                                
                            }else {
                            die('Problème lors de l\'execution');
                        } 
                    } else {
                        die('Problème lors du lien');
                    }
                } else {
                    die('Problème lors de la preparation');
                }
            } catch( PDOException $e){
                die( $e->getMessage() );
                }
        } else {
            $error ="Veuillez entrer un mot de passe";
        }
    } else {
        $error ="Veuillez entrer un login";
    }
   
}



/***************************************************************************************************** */
                                            // Functions  Ajout // 
/***************************************************************************************************** */
function Show_ajout($user, $dsn,$user_name,$user_psw,$nbr_role){
    if (isset($user[0]['AUT_id'])) {
        for ($i=0; $i < 5 ; $i++) { // Pour le 5 faire une function pour count 
            if ($user[$i]['AUT_id'] == 1) {
                return True ;
            }
        }
    } return False;
 }

function Show_ajouter($user, $dsn,$user_name,$user_psw,$nbr_role){
    if (isset($user[0]['AUT_id'])) {
        $all_role =  All_role($dsn,$user_name,$user_psw) ;
        // var_dump ($all_role);
        $show_role = Show_role($nbr_role, $all_role) ;
        // var_dump ($show_role);
        $show = ' <div>
                        <form action="" method="post">
                        <h2> Module d\'ajout d\'user </h2>
                        <p> Veuillez saisir le login de la personne </p>
                        <input type="text" name="ajout_login" id="">
                    <p> Veuillez saisir le mot de passe de la personne </p>
                    <input type="password" name="ajout_psw" id=""> <br>';
        $show .=  $show_role ;
        $show .= '<button type="submit" name="ajout">Ajout</button>  </form> </div>';
        return $show; 
    } 
}

function Show_role($nbr_role, $all_role) {
   if(count($all_role) > 1 ) {
    $str =' <p> Veuillez choisir un rôle </p> <select name="ajout_rank"> ';
        for ($i=0; $i < $nbr_role   ; $i++) { 
            $str .= '<option value='. $all_role[$i]['ROL_id'] .'>' .  $all_role[$i]['ROL_name'] . '</option>'; 
        }
    $str .='</select>';
    return $str; 
   }  
}

function All_role($dsn,$user_name,$user_psw) {
    try {
        $db= new PDO($dsn,$user_name,$user_psw,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    
        if( ($requete = $db->query('SELECT `ROLE`.* FROM `ROLE`' )) !== false ) {
            if ( ($all_role = $requete->fetchAll(PDO::FETCH_ASSOC))  !== false ){
                $requete->closeCursor(); // fermer la BDD
                return $all_role;
              }
        } 
    } catch( PDOException $e){
        die( $e->getMessage() );
        }
} 

function Ajout($login, $psw, $role, $dsn, $user_name, $user_psw) {
    try {
        $db= new PDO($dsn,$user_name,$user_psw,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    
        if( ($requete = $db->prepare('  INSERT INTO `USER` (`USE_login`, `USE_psw`,`USE_role_fk`) 
                                        VALUES (:login, :psw,:rank ) ')) !== false ) {
            if ( $requete->bindValue('login', $login) && $requete->bindValue('psw', $psw)  && $requete->bindValue('rank', $role)  ) {
                if( $requete->execute() ) {
                    $requete->closeCursor(); // fermer la BDD
                    return 'Le nouveau user a bien été rentré';
             } die('Problème lors de execute ');
              } 
              die('Problème lors du Bindvalue ');
        } 
    } catch( PDOException $e){
        die( $e->getMessage() );
        }
} 




/***************************************************************************************************** */
                                            // Functions  Montrer les USERS // 
/***************************************************************************************************** */


function All_user($dsn,$user_name,$user_psw) {
    try {
        $db= new PDO($dsn,$user_name,$user_psw,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    
        if( ($requete = $db->query('SELECT `USER`.`USE_id`,`USER`.`USE_login`,`USER`.`USE_psw`, `ROLE`.`ROL_name`  
                                    FROM `USER` 
                                    JOIN `ROLE` ON `USER`.`USE_role_fk` = `ROLE`.`ROL_id`' )) 
                                    !== false ) {
            if ( ($all_user = $requete->fetchAll(PDO::FETCH_ASSOC))  !== false ){
                $requete->closeCursor(); // fermer la BDD
                return $all_user;
              }
        } 
    } catch( PDOException $e){
        die( $e->getMessage() );
        }
} 

function Show_all_user($all_user, $user, $dsn,$user_name,$user_psw,$nbr_role){

    $str = ' <div>
                <table s>
                <tr >
                    <th >  Id </th>
                    <th>  Login </th>
                    <th>  Mot de passe </th>
                    <th>  Role </th> ';
    $str .= ' </tr>
    ';
    for ($i=0; $i < count($all_user) ; $i++) { 
        $str .= '<tr>';
        foreach ($all_user[$i] as  $key => $value) {
            $str .= '<td>'. $value .'</td>' ;
       }
       $str .='   </tr>';
    }
    

    $str .= '</tr>  
                </table>
             </div> ';

    return $str;
}

/***************************************************************************************************** */
                                            // Functions  SUPPRESSION // 
/***************************************************************************************************** */
      
 function Show_suppression($user, $dsn,$user_name,$user_psw,$nbr_role){
    if (isset($user[0]['AUT_id'])) {
        for ($i=0; $i < 5 ; $i++) { // Pour le 5 faire une function pour count 
            if ($user[$i]['AUT_id'] == 2) {
                return True ;
            }
        }
    } return False;
 }

 function Supprimer($suppr,$dsn,$user_name,$user_psw ) {
    try {
        $db= new PDO($dsn,$user_name,$user_psw,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    
        if( ($requete = $db->prepare('  DELETE  FROM `USER` WHERE `USE_id`= :supprimer
                                        ')) !== false ) {

            if ( $requete->bindValue('supprimer', $suppr) ) {

                if( $requete->execute() ) {
                    $requete->closeCursor(); // fermer la BDD
                    return ' <p> L\'user a bien été supprimé </p> ';
             } die('Problème lors de execute ');
              } 
              die('Problème lors du Bindvalue ');
        } 
    } catch( PDOException $e){
        die( $e->getMessage() );
        }
} 


function Show_all_user_suppression($all_user, $user, $dsn,$user_name,$user_psw,$nbr_role){

    $str = ' <div>
                <table s>
                <tr >
                    <th >  Id </th>
                    <th>  Login </th>
                    <th>  Mot de passe </th>
                    <th>  Role </th> ';
    
    if (Show_suppression($user, $dsn, $user_name, $user_psw, $nbr_role) == true) {
        $str .= '<th> Suppression </th>';
    }
    $str .= ' </tr>
    ';
    for ($i=0; $i < count($all_user) ; $i++) { 
        $str .= '<tr>';
        foreach ($all_user[$i] as  $key => $value) {
            $str .= '<td>'. $value .'</td>' ;
       }
       if (Show_suppression($user, $dsn,$user_name,$user_psw,$nbr_role) == true) {
       $str .= ' <td> <input type="radio" value="'.$all_user[$i]['USE_id'].'" name="suppression"> </td>';
       }
       $str .='   </tr>';
    }
    

    $str .= '</tr>  
                </table>
             </div> ';

    return $str;
}


 /***************************************************************************************************** */
                                            // Functions  MODIFICATION // 
/***************************************************************************************************** */

function Show_modifictaion($user, $dsn,$user_name,$user_psw,$nbr_role){
    if (isset($user[0]['AUT_id'])) {
        for ($i=0; $i < 5 ; $i++) { // Pour le 5 faire une function pour count 
            if ($user[$i]['AUT_id'] == 3) {
                return True ;
            }
        }
    } return False;
 }

 function Show_all_user_modifier($all_user, $user, $dsn,$user_name,$user_psw,$nbr_role){

    $str = ' <div>
                <table s>
                <tr >
                    <th >  Id </th>
                    <th>  Login </th>
                    <th>  Mot de passe </th>
                    <th>  Role </th> ';
    
    if (Show_modifictaion($user, $dsn, $user_name, $user_psw, $nbr_role) == true) {
        $str .= '<th> Modifier </th>';
    }
    $str .= ' </tr>
    ';
    for ($i=0; $i < count($all_user) ; $i++) { 
        $str .= '<tr>';
        foreach ($all_user[$i] as  $key => $value) {
            $str .= '<td>'. $value .'</td>' ;
       }
       if (Show_modifictaion($user, $dsn,$user_name,$user_psw,$nbr_role) == true) {
       $str .= ' <td> <input type="radio" value="'.$all_user[$i]['USE_id'].'" name="modification"> </td>';
       }
       $str .='   </tr>';
    }
    

    $str .= '</tr>  
                </table>
             </div> ';

    return $str;
}


function Show_modifier($user, $dsn,$user_name,$user_psw,$nbr_role){
    if (isset($user[0]['AUT_id'])) {
        $all_role =  All_role($dsn,$user_name,$user_psw) ;
        // var_dump ($all_role);
        $show_role = Show_role($nbr_role, $all_role) ;
        // var_dump ($show_role);
        $show = ' <div>
                     login :
                    <input type="text" name="modif_login" id="">
                    mot de passe de la personne :
                    <input type="password" name="modif_psw" id=""> <br>';
        $show .=  $show_role ;
        $show .= '<button type="submit" name="modifier"> Modifier un user</button>';
        return $show; 
    }
}  

function Modifier($user_id, $login, $psw, $rank, $dsn,$user_name,$user_psw ) {
    try {
        $db= new PDO($dsn,$user_name,$user_psw,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    
        if( ($requete = $db->prepare('  UPDATE `USER`
                                        SET `USE_login` = :login,
                                            `USE_psw` =:psw,   
                                            `USE_role_fk`=:rank
                                        WHERE `USE_id` =:id
                                    ')) !== false ) {
            if ( $requete->bindValue('id', $user_id) && $requete->bindValue('login', $login) && $requete->bindValue('psw', $psw)  && $requete->bindValue('rank', $rank)  ) {
                if( $requete->execute() ) {
                    $requete->closeCursor(); // fermer la BDD
                    return 'L\'user a bien été modifé';
             } die('Problème lors de execute ');
              } 
              die('Problème lors du Bindvalue ');
        } 
    } catch( PDOException $e){
        die( $e->getMessage() );
        }
}

?> 


