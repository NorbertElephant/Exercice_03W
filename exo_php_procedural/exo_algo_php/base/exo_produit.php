<?php
// Écrire un algorithme qui demande deux nombres à l’utilisateur et l’informe ensuite si leur
// produit est négatif ou positif (on laisse de côté le cas où le produit est nul).
// Attention toutefois : on ne doit pas calculer le produit des deux nombres.

$valeurs1 = readline ('Saisir la valeurs 1 : ');
$valeurs2 = readline ('Saisir la valeurs 2 : ');

If ($valeurs1 > 0 && $valeurs2 > 0) {
    echo 'Le produit des deux valeurs est positif ';
} elseif ($valeurs1 < 0 && $valeurs2 < 0) {
    echo 'Le produit des deux valeurs est positif ';
} else {
    echo 'Le produit des deux valeurs est négatif ';
}

?>
