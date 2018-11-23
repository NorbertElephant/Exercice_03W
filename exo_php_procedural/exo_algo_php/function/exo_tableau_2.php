<?php

// En utilisant une fonction récursive, écrire un algorithme qui écrit la structure d’un tableau
// HTML (<table><tr><td></td></tr></table>) en permettant l’écriture de plusieurs lignes et
// plusieurs cellules si l’utilisateur indique qu’il souhaite poursuivre chaque étape.*


/**
 * ecrireTD......Permet d'écrire mes cellules si le client dit oui 
 */

Function ecrireTD() {
    $confirm = readline ('Confirmez-vous l\'écriture d\'une cellule (oui/non) ?');

    if($confirm ==oui ) {
        echo "<td></td>";
        echo ecrireTD();
    };
}

/**
 * ecrireTR......Permet d'écrire des lignes si le client dit oui 
 */

Function ecrireTR(){
    $confirm = readline ('Confirmez-vous l\'écriture d\'une ligne (oui/non) ?');

    if($confirm ==oui ) {
        echo "<tr>";
        echo ecrireTD();
        echo "</tr>";
        echo ecrireTR();
    };
}

/**
 * ecrireTABLEAU......Permet d'écrire le tableau dit oui 
 */

Function ecrireTABLE(){
    echo "<table>";
    echo ecrireTR();
    echo "</table>";
}

echo ecrireTABLE();