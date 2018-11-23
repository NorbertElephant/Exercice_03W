<?php 
$mot = [];  
/**
 * Undocumented function
 *
 * @param [type] $lettre
 * @return void
 */
function ListeDonne(int $chiffre,$mot){
    $donnees = array(
        array('lettre' => 'a', 'suivant' => 10),
        array('lettre' => 'e', 'suivant' => -1),
        array('lettre' => 'e', 'suivant' => 6),
        array('lettre' => 'l', 'suivant' => 1),
        array('lettre' => 'p', 'suivant' => 8),
        array('lettre' => 'o', 'suivant' => 11),
        array('lettre' => 'x', 'suivant' => 12),
        array('lettre' => 'p', 'suivant' => 3),
        array('lettre' => 'r', 'suivant' => 5),
        array('lettre' => 'm', 'suivant' => 7),
        array('lettre' => 'b', 'suivant' => 3),
        array('lettre' => 'b', 'suivant' => 0),
        array('lettre' => 'a', 'suivant' => 9)
        );
        $NbreTab= count($donnees);
    if (isset($chiffre)){
            if ($chiffre >= 0 && $chiffre <= $NbreTab ) {
                do {//// boucle tant que 

                        $Newkey = $donnees[$chiffre]['suivant'];

                        $mot[] = $donnees[$chiffre]['lettre'];
                        
                        $chiffre = $Newkey;
                        
                       
                } while ($chiffre != -1 ); /// jusqu'a que le chiffre  == -1 

            $resultat = implode($mot);
    
            return $resultat ;
                 
            }else {
                return $erreur = 'Vous avez entrer une valeur non valide, entrer une valeur entre 0 et 12';
             }
    } else {
        return $erreur ='Il faut entrer une valeur numérique entre 0 et '. $NbreTab-1;
        }
}
?>

<!--     Algo Principal--> 

<form method ="POST"  >
    <input name="Chiffre" type="number" value ="">
    <input type='submit' value='A voter' </input> 

    <input type= text size='75px' value=' <?php 
        if (ctype_digit($_POST['Chiffre'])){    
            if(isset($_POST['Chiffre'])){
                echo "Le mot est : " . ListeDonne($_POST['Chiffre'],$mot); 
            }
        }
        ?>  ' 
    </input> 
  

</form>