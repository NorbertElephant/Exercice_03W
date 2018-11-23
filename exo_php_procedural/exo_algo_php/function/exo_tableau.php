<?php

// En utilisant une fonction récursive, écrire un algorithme qui écrit la structure d’un tableau
// HTML (<table><tr><td></td></tr></table>) en permettant l’écriture de plusieurs lignes et
// plusieurs cellules si l’utilisateur indique qu’il souhaite poursuivre chaque étape.*


/**
 * GenTD......Permet d'afficher des cellules si le client dit oui 
 * @return string ......... écrire <td></td>
 */

Function genTD(){
    $confirm = readline ('Confirmez-vous l\'écriture d\'une cellule (oui/non) ?');
    $tmp ="";

    if($confirm == 'oui' ) {
        $tmp = "\n      <td></td>" . genTD();
    };
    return $tmp;
}

/**
 * GenTR......Permet d'afficher des lignes si le client dit oui 
 * @return string ......... écrire <tr></tr>
 */

Function genTR() {
    $confirm = readline ('Confirmez-vous l\'écriture d\'une ligne (oui/non) ?');
    $tmp ="";

    if($confirm == 'oui' ) {
        $tmp = "\n    <tr>" . genTD() . "\n    </tr>" . genTR();
    };
    return $tmp;
}

/**
 * genTD ......Permet générer un tableau avec <td> et <tr>
 * @return string ......... Génaration du tableau entier
 */

Function genTABLE(){
    return "<table> \n    <tbody> " . genTR() . "\n    </tbody \n</table";
}

echo genTABLE();

?>