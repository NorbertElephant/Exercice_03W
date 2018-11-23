<?php

require ('functions-loto.php');

///////// Algo principal ///////////////////////////////////

$Monnaie = 100;

define ("COUTGRILLE", 2); 

$Jouer = readline('Voulez-vous jouer au Loto ? (oui /non)  ');

if( $Jouer == 'oui') {
    LotoComplet($Jouer,$Monnaie);
} else {
    echo "Merci de votre participation, aurevoir !" ; 
}

?> 
