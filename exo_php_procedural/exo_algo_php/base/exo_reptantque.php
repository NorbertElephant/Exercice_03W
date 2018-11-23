<?php

$somme = 0;
$i = 0; 

echo "Pour arrêter la saisie de note écrire -1\r\n"; 

do {
    $i++;
    $note = readline ('note '. $i . ' : ');
    if ($note != -1) {
        $somme += $note;
    }

} while( $note != -1);

echo $somme;

?> 