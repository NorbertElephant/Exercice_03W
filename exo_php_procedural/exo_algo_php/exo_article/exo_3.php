<?php

$article = [ 1 => [ "Titre" => "Titre_1" ,
                    "Texte" => "Texte_1",
                    "Image" => "Image_1"],
            2 => [  "Titre" => "Titre_2",
                    "Texte" =>"Texte_2",
                    "Image" => "Image_2"],
            3 => [  "Titre" =>"Titre_3",
                    "Texte" => "Texte_3" ,
                    "Image" =>"Image_3"],
             4 => [ "Titre" =>"Titre_4" ,
                    "Texte" => "Texte_4" ,
                    "Image" => "Image_4"],
            5 => [  "Titre" =>"Titre_5",
                    "Texte" =>"Texte_5" ,
                    "Image" =>"Image_5"]
];

$blog = [];


// Boucle pour avoir 3 articles au hasard
for($i = 1; $i <= 3; $i++){
    
  // Condition pour ne pas avoir des doublons d'articles lors du random  
    do {

        $articleJour = $article[random_int(1,5)];

    } while(in_array($articleJour, $blog));
    
    array_push($blog, $articleJour);

    // Affichage aléatoire de l'article 

    $j = random_int(1,3);

    if($j == 1){

        echo $articleJour["Titre"].$articleJour["Texte"].$articleJour["Image"]. "\r\n";
 
     } elseif ($j == 2) {
 
         echo $articleJour["Image"].$articleJour["Titre"].$articleJour["Texte"]. "\r\n";
 
 
     } else {
 
         echo $articleJour["Titre"].$articleJour["Image"].$articleJour["Texte"]. "\r\n";
     }


}

?>