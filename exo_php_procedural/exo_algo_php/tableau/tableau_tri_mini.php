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
 * triMinimum......Tri les notes du plus petit au plus grand
 * @param I/O mixed $t.... entrée tableau notes 
 * @param int $nb..... nombres de notes
 * @return void moyenne
 */
Function triMinimum(&$t, $nb) {
    For($i = 1; $i < $nb - 1; $i++){
        if (indiceMinimum( $t, $nb, $i ) != $i) {

            inverserValeur( $t[$i], $t[indiceMinimum( $t, $nb, $i )] );
        }
    }
}

/**
 * indiceMinimum......Permet de trouver le nombre le plus petit 
 * @param  float $t.... entrée tableau notes 
 * @param float $nb..... nombres de notes
 * @param  float $rang..... repérer la valeur dans le tableau
 * @return float $indice..... retour de la valeur la plus petite
 */
Function indiceMinimum($t, $nb, $rang) {
    $indice = $rang;
    for ($i = $rang + 1; $i <= $nb ; $i++) {
        if($t[$i] < $t[$indice]){ 
            $indice = $i;
        }
    }
return $indice;
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

    

// Écrire un programme qui affiche en ordre croissant les
// notes d'une promotion de 10 élèves, suivies de la note la
//  plus faible, de la note la plus élevée et de la moyenne.

$notes = array();
$nbNote = saisirNote($notes);

echo "Voici le tableau non trié : \r\n";

afficherNote( $notes, $nbNote );

triMinimum( $notes, $nbNote );

echo "\r\n Voici le tableau trié : ";

afficherNote( $notes, $nbNote );

echo "\r\n Note la plus faible :". $notes[1] . "\r\n" ;

echo "Note la plus élevée : ". $notes[$nbNote] . "\r\n";

echo "Moyenne :". moyenne( $notes, $nbNote ) . "\r\n" ;