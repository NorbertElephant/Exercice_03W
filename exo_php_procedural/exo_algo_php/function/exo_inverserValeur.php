<?php
// Écrire un algorithme qui échange la valeur de deux variables en s’appuyant sur une fonction
// ou une procédure.
// Exemple, si a ← 2 et b ← 5, le programme donnera a ← 5 et b ← 2.

/**
 * inverserValeur......Permet d'inverser des valeurs
 * @param I/O mixed $a 
 * @param I/O mixed $b
 * @return void
 */
Function inverserValeur (&$a,&$b) {
    $tmp = $a;
    $a = $b;
    $b = $tmp;
}

$a = 2;
$b =5;


echo 'La variable a est égale à ' . $a . ' et la variable b est égale à ' . $b  ;

inverserValeur ($a, $b) ;


echo 'La variable a est égale à ' . $a . ' et la variable b est égale à ' . $b  ;

?>
