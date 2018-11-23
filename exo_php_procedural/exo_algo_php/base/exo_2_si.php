<?php

$maNote = readline ('Quel est la moyenne de l\'élève ? ');

if ($maNote >= 12 ) {
    echo  'Reçu avec mention Assez Bien';
} elseif ($maNote < 12 && $maNote > 10 ){
        echo 'Reçu avec mention Passable ';
    }
else{
        echo ' Insuffisant';
    }

?>