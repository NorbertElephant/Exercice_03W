<?php
/**
 * NuméroDuClient............ Connaitre les numéros des clients
 * @param 
 * @return array $nombresDuclients...... les 6 chiffres du clients
 */
function NuméroDuClient(){

    $nombresDuClients= [];

    for ($i=0; $i < 6 ; $i++) { // boucles pour avoir 6 chiffres 

        $nombre= readline('Veuillez saisir un nombre entre 1 et 49 : ' );

        if ($nombre < 1 || $nombre > 49) {
            $nombres = readline('Le chiffre que vous avez entrer n\'est pas compris entre 1 et 49 : ' );
        }
        elseif (in_array($nombre, $nombresDuClients)) {
        $nombres = readline('Veuillez saisir un autre nombre non égale à ce que vous avez déjà entrer : ' );
        } else {
            $nombresDuClients [] = $nombre;
        }
    }

    return $nombresDuClients;

    }

/**
 * ResultatLoto............Tire 6 chiffres au hasard 
 *
 * @return void
 */
function ResultatLoto(){ // Resultat du Loto  

    $TabLoto=[];

    for ($i=0; $i < 6 ; $i++) { // Boucle pour avoir sortie du Loto sans Doublons 

    do {
   
        $NombresLoto= random_int(1,49); 

    } while(in_array($NombresLoto, $TabLoto));

    array_push($TabLoto, $NombresLoto);
    }

    return $TabLoto;
}

/**
 * ComparaisonLoto............. Comparaison + gains entre num du client et Loto
 *
 * @param array $nombresDuClients........... 6 nombres du client
 * @param array $TabLoto.............6 nombres du Loto
 * @param I/O int  $Monnaie............ Porte Monnaie du Client
 * @return void
 */

function ComparaisonLoto($nombresDuClients,$TabLoto){

    $NuméroGagnant = array_intersect($nombresDuClients,$TabLoto); /// Connaitre les numéros Commums entre chaque tableaux 


    switch (count($NuméroGagnant)) { // Pour chaque cas, connaitre le nombre de numéro gagnant et dire les les numéros.
        case '0':
            echo "Vous n'avez aucun numéro en commun". "\r\n ";
        break;
        case '1':
            echo 'Vous avez '.count($NuméroGagnant). ' numéro en commun qui est le numéro :  '. implode(', ', $NuméroGagnant) . "\r\n ";
            break;
        case '2':
            echo 'Vous avez '.count($NuméroGagnant). '  numéro en commun qui sont les numéros :'. implode(', ', $NuméroGagnant). "\r\n ";
           
            break;
        case '3':
            echo 'Vous avez '.count($NuméroGagnant). '  numéro en commun qui sont les numéros :'. implode(', ', $NuméroGagnant). "\r\n ";
            
        break;
        case '4':
            echo 'Vous avez '.count($NuméroGagnant). '  numéro en commun qui sont les numéros :'. implode(', ', $NuméroGagnant). "\r\n ";
            
        break;
        case '5':
            echo 'Vous avez '.count($NuméroGagnant). '  numéro en commun qui sont les numéros :'. implode(', ', $NuméroGagnant). "\r\n ";
            
        break;
        case '6':
            echo 'Vous avez '.count($NuméroGagnant). '  numéro en commun qui sont les numéros :'.implode(', ', $NuméroGagnant) . "\r\n ";
        break;
        }

}

?>