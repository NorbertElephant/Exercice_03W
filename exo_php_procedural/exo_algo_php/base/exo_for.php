<?php
$nbNote = readline ('Nombre de note à rentrer ? ' );
$somme = 0;

for ($i=1; $i <= $nbNote ; $i++) { 
   $note = readline ('note '. $i. ' : ' );
   $somme += $note;
   
}

echo "Le total des $nbNote valeurs est : $somme";

?> 