<?php
// Écrire un algorithme qui échange la valeur de deux variables.
// Exemple, si a ← 2 et b ← 5, le programme donnera a ← 5 et b ← 2.

$a = 2;
$b =5;
$tmp = 0;

echo 'La variable a est égale à ' . $a . ' et la variable b est égale à ' . $b  ;

$tmp = $a;
$a = $b;
$b = $tmp;

echo 'La variable a est égale à ' . $a . ' et la variable b est égale à ' . $b  ;

?>