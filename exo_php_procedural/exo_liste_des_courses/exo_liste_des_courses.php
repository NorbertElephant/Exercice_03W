<?php 
    session_start();
/**
 * aarray_search
 *
 * @param [type] $needle
 * @param [type] $haystack
 * @return void
 */
    function aarray_search($needle, $haystack){
        foreach ($haystack as $key => $value) {
            if( $value['art']== $needle){
                return $key;
            }
        }
        return false;
    }


// système de d'ajout de produits sans doublons 
    if(isset($_POST['article'],$_POST['quantity'],$_POST['add'])) {
        if(is_numeric($_POST['quantity'])) {

            if (isset($_SESSION['cart']) && ($key = aarray_search($_POST['article'],$_SESSION['cart']) !== false)) { // fonction de recherche sur un tableau associé

                if($_SESSION['cart'][$key]['qty']+ $_POST['quantity'] <= 0 ){
                    // Si le calcul est égal à 0 ou moins suppression de l'article
                    unset($_SESSION['cart'][$key]);

                }else {
                    $_SESSION['cart'][$key]['qty'] +=  $_POST['quantity'];
                }   
                
            } else {
                $_SESSION['cart'][] = array(
                    "art" => $_POST['article'],
                    "qty" => $_POST['quantity']
                );
            }  
        }else {
            echo 'Mauvaise saisie ! Veuillez indiquer une quantité numérique'; 
        }
           
}
// Système de suppresion de produits
if (isset($_SESSION['cart'],$_POST['del']) && count($_POST)>0 ){
    foreach ($_POST as $keyCart => $checked) {
        unset($_SESSION['cart'][$keyCart]);
    }
}

?> 


<form method='POST'>

    <input name="article" placeholder="Saisissez un produit"  type ='text' >
    <input name="quantity" placeholder="Saisissez une quantité"  type ='text' >
    <input name ='add' type='submit'  >
</form>

<?php
if(!empty($_SESSION['cart'])){
?> 
<form method='POST'>
    <table border ="1"> 
        <thead>
            <tr> 
                <th> Article </th>
                <th> Quantity </th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan='3'> <input name="del" type="submit" value="Supprimer"/> </td>
        </tfoot>
        <tbody>
            <?php

                foreach ($_SESSION['cart'] as $key => $article) {

                    echo '<tr><td>' .$article['art'] . ' </td><td> ' . $article['qty'] . '</td><td> <input name="'.$key.'" type="checkbox" </td></tr>' ;
                }
            ?>
        </tbody>
    </table> 
</form>
<?php

}
