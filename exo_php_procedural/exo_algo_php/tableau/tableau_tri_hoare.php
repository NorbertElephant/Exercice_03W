<?php
/**
 * triRapide......Tri Rapide Hoare
 * @param I/O mixed $t 
 * @param  $premier
 * @param  $dernier
 * @return void
 */
Function triRapide (&$t, $premier, $dernier) {
    if($premier < $dernier){ 

        $p = partition( $t, $premier, $dernier );

        triRapide( $t, $premier, $p );

        triRapide( $t, $p + 1, $dernier );

    }
}


/**
 * partition......
 * 
 */
Function partition(&$t, $premier, $dernier){

    $pivot = $t[$premier];

    $gauche = $premier - 1;

    $droite = $dernier + 1;

    while ($gauche < $droite) {
        do {

            $gauche = $gauche + 1;
        } while ($t[$gauche] < $pivot);

        do {

            $droite = $droite - 1;
        } while ($t[$droite] > $pivot);


        if ($gauche < $droite){
            inverser( $t[$gauche], $t[$droite] );
            }      
    }
    return $droite;
}

/**
 * inverser......Permet d'inverser des valeurs
 * @param I/O mixed $a 
 * @param I/O mixed $b
 * @return void
 */
Function inverser (&$a,&$b) {
    $tmp = $a;
    $a = $b;
    $b = $tmp;
}

//--------------------------------------------------------
$monTableau = array(12,39,46,10,6,32);

echo "Ordre initial du tableau : \r\n";

print_r( $monTableau) ;

triRapide( $monTableau, 0, 5 );

echo "Ordre final du tableau : \r\n";

print_r( $monTableau) ;