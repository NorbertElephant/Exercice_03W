<?php 
session_start();

/** aaray_search.............. Fonction de recherche pour un tableau MultiDimension pour connexion
 * @param string $needle1........... entrer du nom d'utilisateur
 * @param O/I array $haystack........... Tab des Log
 * @param string $needle2........... entrer du mot de passe 
 * @return Bool 
*/
function aarray_search($needle1, &$haystack,$needle2){
    // var_dump($haystack);
    foreach ($haystack as $key => $value) {
        if( $value['Log']== $needle1){  
            $key1 = $key;

            if( $value['Pwd']== $needle2) {
                    $key2 = $key;
            }
        }   
    }

    if(isset($key1,$key2)) {
        if ($key1 == $key2){

            $haystack['connexion']['Log']= $needle1;
            $haystack['connexion']['Pwd']= $needle2;
            
            
            return true;
        }

    }
        
    return false;
}

// Déconnexion de la Session // 
if(isset($_POST['deco'])) {
    unset($_SESSION['TabLog']['connexion']);
}


/// Tab des Logs /// 
$TabLog = array ( array (
                                    'Log' => 'Bibi' , 
                                    'Pwd' => '1234'),
                                array (
                                    'Log' => 'Bubu' , 
                                    'Pwd' => '1234' ),
                                array (
                                    'Log' => 'Bobo' , 
                                    'Pwd' => '1234'  ));


///////////////////////////////// Algo Principal ////////////////////////////////////

if(isset($_POST['Login'],$_POST['PWD'])){
    if (empty($_POST['Login']) || empty($_POST['PWD']))
        echo "Le nom d'utilisateur ou le mot de passe vide. ";
    
    if (aarray_search($_POST['Login'],$TabLog,$_POST['PWD']) === true) {
    // enregistrement dans une session 
            $_SESSION['TabLog']['connexion'] = $TabLog['connexion'];

        }
    }

// Ce qu'il dit avoir d'afficher après connexion
if(isset($_SESSION['TabLog']['connexion'])){
        echo 'Bienvenu sur le site internet ' . $_SESSION['TabLog']['connexion']['Log'] .'
        <form method="POST">

        <br> <input  name="deco" type="submit" value="Déconnexion" >  
        </form>
        ';
    }



include('ini.php'); 
