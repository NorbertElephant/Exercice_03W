<?php 

/// LE __DIR__ donne : C:\_xampp\htdocs\www\..
$source = __DIR__ . DIRECTORY_SEPARATOR . '10_-_La_gestion_de_fichiers_-_Arborescence'. DIRECTORY_SEPARATOR . 'arborescence_test'. DIRECTORY_SEPARATOR ;

/**
 * 
 */

function is_indexed ($dir) { 
    foreach ( scandir($dir)  as $entry) {
        $fileInfo = pathinfo($dir .$entry);
        if ( is_file($dir .$entry ) && $fileInfo['filename'] == 'index') {
            return true;
        }
    }
    return false;
}


/** fileTree ........... Fonction de recherche Dossier + indexation
 * @param $dir 
 * @param $iteration 
 * @return void
 */

function fileTree( $dir, $iteration = 1){
    $indent = ''; 
    for ( $i =1; $i < $iteration; $i++) {
        $indent = $indent . '    '; 
    } 
        
    if (is_dir($dir)) {
        
        if ( !is_indexed($dir)) {
            foreach ( scandir($dir)  as $entry) {
                if( $entry != '.' && $entry != '..') {
                    echo $entry . "\r\n";
                    if (is_dir($dir . $entry . DIRECTORY_SEPARATOR)) {
                        fileTree($dir . $entry . DIRECTORY_SEPARATOR, $iteration+1);
                    } else {
                        echo "Fichier \r\n"; 
                    }
                }
            }
        }
    }else {
        echo "$indent Indexation Protégéé \r\n";
    }
}


/////////////////// Algo Principal ////////////////////

fileTree ($source);










// // 1er Méthode avec ScanDir
// foreach ( scandir($dir)  as $entry) {
//     if( $entry != '.' && $entry != '..') {
//         echo $entry . "\r\n";
//     }
// }


// // 2 eme Méthode avec OpenDir et ReadDir
// if( ($ressource = opendir($source)) !== false){
//     while( ( $dir = readdir($ressource) )!== false){
//         if ($dir != '.' && $dir != '..'){
//         echo $dir . "\r\n";
//         }
//     }
//     closedir($ressource);
// }

?>