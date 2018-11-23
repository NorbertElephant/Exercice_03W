<?php

$nbreHeureux = 0;
$TabCarré = [];

// idée function 
function Happy($nbreHeureux, $TabCarré){

$carré = 0;
$Total = 0;

$tabHeureux = str_split($nbreHeureux,1); // split du nombre
 
$nbreChiffre = count($tabHeureux);

    while ($nbreChiffre  > 0) { // Tant que $nbreChiffre n'est pas a 0 boucle

        $carré = $tabHeureux[$nbreChiffre-1] * $tabHeureux[$nbreChiffre-1]; // calcul des carrés
                
        $Total = $Total + $carré; // somme des carrés

        $nbreChiffre--;
    }

    if ($Total == 1) { /// Si $Total = 1 Donc Heureux
        return " est un nombre Heureux";
       
    } elseif (in_array($Total, $TabCarré)) { // Voir si carré est dans le Tab

        return " est un nombre MalHeureux";

    } else {
    
        $TabCarré[] = $Total; // Stocker carrés

        return Happy($Total, $TabCarré); // relancer La fonction
        
    }
}

//// utiliser la fonction 

echo $nbreHeureux .  " " . Happy($nbreHeureux, $TabCarré); 


?>