<?php

$nombresDuClients = explode(',', (readline('Veuillez saisir les 6 nombre entre 1 et 49 séparé par une virgule : ' )),6);

switch (count($nombresDuClients)) {
    case '1':
        echo "Vous n'avez saisie que 1 nombres sur les 6 \r\n";
        $clientsBoulet = explode(',', (readline('Veuillez resaisir les 5 autres nombre entre 1 et 49 séparé par une virgule : ' )),5);
        $nombresDuClients= array_merge($nombresDuClients,$clientsBoulet);
        break;

    case '2':
        echo "Vous n'avez saisie que 2 nombres sur les 6\r\n";
        $clientsBoulet = explode(',', (readline('Veuillez resaisir les 4 autres nombre entre 1 et 49 séparé par une virgule : ' )),4);
        $nombresDuClients= array_merge($nombresDuClients,$clientsBoulet);
        break;

    case '3':
        echo "Vous n'avez saisie que 3 nombres sur les 6\r\n";
        $clientsBoulet = explode(',', (readline('Veuillez resaisir les 3 autres nombre entre 1 et 49 séparé par une virgule : ' )),3);
        $nombresDuClients= array_merge($nombresDuClients,$clientsBoulet);
    break;

    case '4':
        echo "Vous n'avez saisie que 1 nombres sur les 6\r\n";
        $clientsBoulet = explode(',', (readline('Veuillez resaisir les  2 derniers nombre entre 1 et 49 séparé par une virgule : ' )));
        $nombresDuClients= array_merge($nombresDuClients,$clientsBoulet);
        break;

    case '5':
        echo "Vous n'avez saisie que 1 nombres sur les 6\r\n";
        $clientsBoulet = explode(',', (readline('Veuillez resaisir le dernier nombre entre 1 et 49  : ' )),1);
        $nombresDuClients= array_merge($nombresDuClients,$clientsBoulet);
        break;
    
} 

foreach ($nombresDuClients as $key=>$value) {

    if ( $value < 1 || $value > 49 ) {
        $nombresDuClients[$key] = readline('Veuillez resaisir un nombre entre 1 et 49 ...... : ');

    }
}

//     // elseif (in_array($value, $nombresDuClients)) {
//     //     $nombresDuClients[$key] = readline('Veuillez saisir un autre nombre non égale à ce que vous avez déjà entrer : ' ); 
/// le soucis c'est que je compare la valeur dans le tableau et lui meme.... 
//     // }


var_dump($nombresDuClients);


?>