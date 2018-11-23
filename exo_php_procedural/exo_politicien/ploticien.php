<?php 

/// Ouvrir le fichier ///
// // $ressource = fopen('C:\_xampp\htdocs\www\exo_politicien\data.txt','r'); 
// echo fread($ressource, filesize('C:\_xampp\htdocs\www\exo_politicien\data.txt'));
// // fclose($ressource);

///// Créer un tab avec les données /// 
$tab =[];
$ressource = fopen('C:\_xampp\htdocs\www\exo_politicien\data.txt','r+'); 

while (!feof($ressource)) { /// récup doonées 
    $tab [] = fgets($ressource,filesize('C:\_xampp\htdocs\www\exo_politicien\data.txt'));
}
// print_r($tab); // Test
// echo count($tab[8]); // Test

/////////////////// Crée les 4 tab ////////////////////////

$tab1=[];
$tab2=[];
$tab3=[];
$tab4=[];
$nbreTab = 3;
$i = 0; 

// tab 1
do {
    array_push($tab1,$tab[$i]);
    $i++;
} while ($tab[$i] !== "\r\n");

// var_dump($tab1); // Test

$tab = array_diff($tab,$tab1);


// tab 2
do {
    array_push($tab2,$tab[$i+1]);
    $i++;
} while ($tab[$i+1] !== "\r\n");

// var_dump($tab2); // Test

$tab = array_diff($tab,$tab2);

// tab 3
do {
    array_push($tab3,$tab[$i+2]);
    $i++;
} while ($tab[$i+2] !== "\r\n");

// var_dump($tab3); // Test

$tab = array_diff($tab,$tab3);

// // tab 4


$tab4 = array_splice($tab,$nbreTab);

// var_dump($tab); // Test
// var_dump($tab4); // Test

/////////////  Exercice ////////////////////
/**
 * Commencer par Tab1[0] 
 * puis Shuflle Tab2 
 * puis Shuflle Tab3 
 * puis Shuflle Tab4 
 * puis Shuffle Tab1 mais pas Tab1[0]
 * Puis Shuffle Tab2 / Tab3 / Tab4 
 * Mais toujours pas utiliser 
 * jusqu'a utiliser tout les cases des Tab 
 */

Function Discours($tab1,$tab2,$tab3,$tab4){

    echo $tab1[0];
    unset ($tab1[0]);
    $tab1 [0] = '';

    shuffle($tab1);
    shuffle($tab2);
    shuffle($tab3);
    shuffle($tab4);
    
    for ($i=0; $i < count($tab1) ; $i++) { 

        $j = random_int(1,5);

        if($j == 1){
    
            echo $tab2[$i].$tab3[$i].$tab4[$i];
         } elseif ($j == 2) {
            echo $tab3[$i].$tab4[$i].$tab2[$i];
     
         } elseif ($j == 3) {
            echo $tab3[$i].$tab2[$i].$tab4[$i];  
         } elseif ($j == 4) {
            echo $tab4[$i].$tab2[$i].$tab3[$i];  
         } else {
            echo $tab2[$i].$tab4[$i].$tab3[$i];     
         };

        echo $tab1[$i];
    }
}

Discours($tab1,$tab2,$tab3,$tab4);



fclose($ressource);
