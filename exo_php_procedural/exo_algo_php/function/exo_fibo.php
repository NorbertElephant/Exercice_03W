<?php
//En utilisant une fonction récursive, écrire un algorithme
//qui détermine le terme U(n) de la suite de Fibonacci
// définie comme suit :
// U0 = 0
// U1 = 1
//Un = U(n-1) + U(n-2), n >= 2

/**
 * Fibonacci......Permet de calculer la suite Fibo
 * @param int $n ....... Nombre
 * @return int ......... Nombre de la suite Fibo
 */

Function Fibonacci( int $n ){
$resultat = 0; 

    if ( $n > 0 ) {
        if ($n == 1) {
            $resultat = 1;
        }    
        else {
        $resultat = Fibonacci( $n - 1 ) + Fibonacci( $n - 2 );
        }
     }
return $resultat; 
}


$n = readline ('Saisir un nombre entier positif : ');
  
echo 'Le résultat de Fibonacci pour '. $n . ' est égale à : ' . Fibonacci( $n );

?>