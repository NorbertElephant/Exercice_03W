<?php


/// Ouvrir le fichier ///
// // $ressource = fopen('C:\_xampp\htdocs\www\exo_politicien\data.txt','r'); 
// echo fread($ressource, filesize('C:\_xampp\htdocs\www\exo_politicien\data.txt'));
// // fclose($ressource);

///// Créer un tab avec les données /// 
$tab =[];
$ressource = fopen('C:\_xampp\htdocs\www\exo_politicien\data.txt','r');


$y=0;
do { /// Création d'un tableau a MultiDimension par la Ressource
    $line = fgets($ressource);

    while ( $line !== "\r\n" && !feof($ressource)){ // Vérifie la première ligne 
        $tab[$y][] = $line;
        $line = fgets($ressource);
    }
    if ( $line !== "\r\n" && feof($ressource)){
        $tab[$y][] = $line;
    }
    $y++;
} while (!feof($ressource));

// print_r($tab); // Test

// /////////////  Exercice ////////////////////
// /**
//  * Commencer par Tab1[0] 
//  * puis Shuflle Tab2 
//  * puis Shuflle Tab3 
//  * puis Shuflle Tab4 
//  * puis Shuffle Tab1 mais pas Tab[0]
//  * Puis Shuffle Tab2 / Tab3 / Tab4 
//  * Mais toujours pas utiliser 
//  * jusqu'a utiliser tout les cases des Tab 
//  */

Function Discours($tab){

    echo $tab[0][0];
    unset ($tab[0][0]);
    $tab[0][0] = '';

    $nombreLignes = count($tab[0]); // = $i
    $nombreArticles = count($tab); // = $n

   
    shuffle($tab[0]);
    shuffle($tab[1]);
    shuffle($tab[2]);
    shuffle($tab[3]);
    
    for ($i=0; $i >= $nombreLignes ; $i++) { 

        for ($n=0; $n >= $nombreArticles; $n++) {
            echo $tab[$n][$i];
        }
    }

}

Discours($tab);



fclose($ressource);