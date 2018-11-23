<?php

// Écrire un algorithme qui demande un nombre compris entre 10 et 20, jusqu’à ce que la
// réponse convienne.
// En cas de réponse supérieure à 20, on fera apparaître un message : "Plus petit !" , et
// inversement, "Plus grand !" si le nombre est inférieur à 10.

do {
    $nombre = readline ('Veuillez saisir un nombre entre 10 et 20 : ');
    if ($nombre < 10) {
        echo 'Plus grand ! ';
    } elseif ($nombre > 20) {
        echo ' Plus petit !';
    } else{
        echo ' Tu sais lire une instruction bravo !';
    }
} while ($nombre <= 10 || $nombre >= 20 );

?>
