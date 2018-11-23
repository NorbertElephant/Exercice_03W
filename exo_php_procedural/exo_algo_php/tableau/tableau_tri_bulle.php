<?php
/**
 * saisirNote......Permet de saisir mes notes entre 0 et 20
 * @param  float $t.... entrée tableau notes 
 * @return int $indice 
 */
Function saisirNote(&$t) {
    $STOP = -1;

    $indice = 0;

    do {

        $note = readline (" Veuillez saisir une note (-1 pour arrêter) : ") ;
        
        while (($note != $STOP) && ($note < 0 || $note > 20)) {
        $note  = readline ( "La note doit être comprise entre 0 et 20 !\nNouvelle saisie : ");
        } 
       
       if ($note != $STOP) {
        $indice = $indice + 1;
        $t[$indice] = $note;
       }
    } while ($note != $STOP);

return  $indice;
}

/**
 * afficherNote......Permet d'afficher les notes
 * @param  float $t.... entrée tableau notes 
 * @param  int $nb..... nombres de notes
 * @return void 
 */
Function afficherNote($t, $nb) {
    for ($i = 1 ; $i <= $nb ; $i++) {
        echo $t[$i];
    }
}

/**
 * triBulles......tri du tableau par bulle 
 * @param I/O mixed $t.......... entrée sortie tableau 
 * @param  $nb......... nombres de notes saisies
 * @return void
 */
Function triBulles(&$t, $nb) {

    for ($i = $nb-1 ; $i >= 1; $i--) {

        for($j = 1; $j <= $i; $j++) {
            if( $t[$j+1] < $t[$j]) {
                inverserValeur( $t[$j], $t[$j+1] );
            }
        }
    }
}

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

/**
 * moyenne......Permet de calculer la moyenne des notes
 * @param I/O mixed $t.... entrée tableau notes 
 * @param I/O mixed $nb..... nombres de notes
 * @return int moyenne..... calcul de la moynne 
 */
Function moyenne($t, $nb){
    $somme = 0;
    For($i = 1; $i < $nb+1; $i++){
        $somme = $somme + $t[$i];
    }
return $somme / $nb;
}
    

/*
 Ecrire un programme qui affiche en ordre croissant les
 notes d'une promotion de 10 élèves, suivies de la note la
 plus faible, de la note la plus élevée et de la moyenne.
*/ 

$notes = [];

$nbNote = saisirNote( $notes );

echo "Voici le tableau non trié : \r\n";
afficherNote( $notes, $nbNote );

triBulles( $notes, $nbNote );

echo "\r\n Voici le tableau trié : \r\n";
afficherNote( $notes, $nbNote ). "\r\n";

echo "\r\n Note la plus faible :". $notes[1] . "\r\n";

echo "Note la plus élevée :". $notes[$nbNote] . "\r\n";

echo "Moyenne : ". moyenne( $notes, $nbNote ). "\r\n";

?>