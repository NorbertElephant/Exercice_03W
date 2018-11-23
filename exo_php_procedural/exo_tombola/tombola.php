<?php 

session_start(); 

if(isset($_POST['reset'])) {
    unset($_SESSION['Tombola']['NumDuClient']);
    unset($_SESSION['Tombola']['TabLoto']);
    header('location: index.php'); 
    exit;
}

if(isset($_POST['over'])) {
    unset($_SESSION['Tombola']['NumDuClient']);
    unset($_SESSION['Tombola']['TabLoto']);
    unset($_SESSION['Tombola']['Monnaie']);
    unset($_SESSION['Tombola']['Histo']);
    header('location: index.php'); 
    exit;
}


/**
 * NuméroDuClient............ Connaitre les numéros des clients
 * @param 
 * @return array $_SESSION['Tombola']['NumDuClient']...... les tickets achetés 
 */
function NuméroDuClient($NombresDeTickets){

    $_SESSION['Tombola']['NumDuClient'] = [];

for($j=0; $j <= $NombresDeTickets-1;$j++ ) {
    
        do {
        
            $NombresLoto= random_int(1,100); 

        } while(in_array($NombresLoto, $_SESSION['Tombola']['NumDuClient']));

        array_push($_SESSION['Tombola']['NumDuClient'], $NombresLoto);
}
   
    sort($_SESSION['Tombola']['NumDuClient']); // Ranger le Tableau dans l'ordre croissant 

    return $_SESSION['Tombola']['NumDuClient'];
}


/**
 * ResultatLoto............Tire 6 chiffres au hasard 
 *
 * @return Array $_SESSION['Tombola']['TabLoto']
 */
function ResultatLoto(){ // Resultat du Loto  

    $_SESSION['Tombola']['TabLoto']=[];

    for ($i=0; $i < 3 ; $i++) { // Boucle pour avoir sortie du Loto sans Doublons 

    do {
   
        $NombresLoto= random_int(1,100); 

    } while(in_array($NombresLoto,  $_SESSION['Tombola']['TabLoto']));

    array_push( $_SESSION['Tombola']['TabLoto'], $NombresLoto);
    }

    return  $_SESSION['Tombola']['TabLoto'];
}

/**
 *ComparaisonLoto ............ Comparer les numéros Gagnants
 *
 * @param Array $nombresDuClients................. Numéros Du clients
 * @param Array  $TabLoto..................... Numéros du Tirage
 * @param Int $Monnaie................ Montant du Porte-Feuille Client
 * @return void
 */
function ComparaisonLoto($nombresDuClients,$TabLoto,&$Monnaie){

    $NuméroGagnant = array_intersect($TabLoto,$nombresDuClients); /// Connaitre les numéros Commums entre chaque tableaux 

    foreach ($NuméroGagnant as  $value) {
        if($value == $TabLoto[0]){
            echo "Vous avez gagné le Premier Prix gâce au numéro ". $value." et donc gagner " . GAIN1 . "€ <br>";
            $Monnaie += GAIN1;
        } elseif ($value == $TabLoto[1]) {
            echo "Vous avez gagné le Second Prix gâce au numéro ".  $value." et donc gagner " . GAIN2 . "€ <br>";
            $Monnaie += GAIN2;
        }elseif ($value == $TabLoto[2]) {
            echo "Vous avez gagné le Troisième Prix gâce au numéro  ".  $value." et donc gagner " . GAIN3 . "€ <br>";
            $Monnaie += GAIN3 ;
        } 
    } 
    if (count($NuméroGagnant) == 0 ){
        echo "Vous n'avez aucun numéro en commun <br>";
    }

}

/** Loto Complet.............. Algo complet qui redemande s'il le client veut refaire une grille 
 * @param int $Monnaie ............ l'argent du joueur
 * @param int $nbTicket ............ NB Ticket achetés
 * @return void
 */

Function LotoComplet ($nbTicket,&$Monnaie) {


    $Monnaie = $Monnaie - (COUTGRILLE * $nbTicket) ; 

   if ($Monnaie >0){ 
    NuméroDuClient($_POST['NombresTickets']);

    echo "<br> Vous avez achetés". $nbTicket." tickets avec comme nombres :  ". implode(', ',$_SESSION['Tombola']['NumDuClient'] ) ."<br>" ;

    $_SESSION['Tombola']['TabLoto'] = ResultatLoto();

    echo "Les nombres du tirage de la Tombola sont ". implode(', ',$_SESSION['Tombola']['TabLoto'] )."<br>";

    ComparaisonLoto($_SESSION['Tombola']['NumDuClient'],$_SESSION['Tombola']['TabLoto'],$Monnaie );

    echo "<br> Votre porte-monnaie comporte actuellement $Monnaie euros <br> ";

   } 


if ($Monnaie <= COUTGRILLE) {
    echo "Vous n'avez pas assez d'argent pour acheter autant de ticket.";
}
    

}
//////////////


?> 






