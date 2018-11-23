<?php

$nbreHeureux = 11;
$TabCarré = [];

/**
 * Happy 
 * (recursive way)
 * @param int $nbreHeureux
 * @param array $TabCarr
 * @return void
 */
function Happy($nbreHeureux,$TabCarré){

$carré = 0;
$Total = 0;

$tabHeureux = str_split($nbreHeureux,1); // split du nombre
 
$nbreChiffre = count($tabHeureux);

// echo $nbreChiffre . "\r\n"; // débug
    
for ($j = $nbreChiffre -1; $j >= 0; $j--) {// boucle de $j

            $carré = $tabHeureux[$j] * $tabHeureux[$j]; // calcul du premier carré ++
            
            $Total = $Total + $carré; // somme  des carrés
        }  

if ( $Total == 1) {

    return " est bien un nombre Heureux";

} elseif (in_array($Total, $TabCarré)) {

    return "est un nombre Malheureux ";

}  else { // si résultat de $Total non égale a 1 refaire la fonction -- Récursivité 

    $TabCarré[] = $carré; // Stocker carrés 

    return Happy($Total,$TabCarré);
}
}

//// utiliser la fonction 

echo $nbreHeureux .  " ". Happy($nbreHeureux, $TabCarré ); 



?>