<?php

$maNote = readline ('Saisir une valeur : ') ;
$seuil = readline ('Saisir un seuil : ');


if (($maNote*2 ) < ($seuil*2)) {
    echo  "Le double de $maNote est " . ($maNote*2);
} else {
    echo "la valeur dépasse le seuile établi à $seuil";
}

?>