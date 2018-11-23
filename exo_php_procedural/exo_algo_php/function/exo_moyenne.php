<?php 

// \\ Écrire le sous-algorithme de la fonction "moyenne" qui
// \\ renvoie la moyenne de deux entiers.
// \\ Écrire l'algorithme qui contient la déclaration de la
// \\ fonction moyenne et des instructions qui appellent cette
// \\ fonction.

/**
 * Moyenne......Permet de calculer la moynne des paramètres
 * @param float $a ....... Note
 * @param float $b ....... Note
 * @return float ......... Calcule de la moyenne
 */

Function Moyenne (float $a,float $b) {

    return ($a + $b ) / 2;

    }

$nombre1 = readline("Saisir un nombre : " ) ;
$nombre2 = readline("Saisir un autre nombre : " );

echo 'La moyenne de ' .  $nombre1 . ' et '. $nombre2 . ' est : '. moyenne( $nombre1, $nombre2 );

?>