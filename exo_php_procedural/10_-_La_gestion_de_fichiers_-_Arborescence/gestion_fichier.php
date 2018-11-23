<?php 
/** ParcoursDossier ..... Fonction qui va chercher les dossiers et fichiers
 * 
 */

Function ParcourDossier( $dossier, $iteration) {
    if(is_dir($dossier)) {
        if($rootDossier = opendir($dossier)){
           while (($fileDossier = readdir($rootDossier)) !== false) {
                if (is_dir($dossier . '/' . $fileDossier) && $fileDossier !== '.' && $fileDossier !== '..' ) {

                    if(!stristr($fileDossier, 'index')  || !stristr($fileDossier, 'invisible')) {
                        if($iteration==0){
                            echo "  Dossier: $fileDossier \r\n";
                            ParcourDossier($dossier . '/' .$fileDossier, $iteration+1);
                        }else {
                            echo "      Dossier: $fileDossier \r\n";
                            ParcourDossier($dossier . '/' .$fileDossier, $iteration+1);
                        } 
                     }
                }
                if (is_file($dossier . '/' . $fileDossier)){
                   
                    if(stristr($fileDossier,'index') == false && stristr($fileDossier,'invisible') == false) {

                       if($iteration==0){
                        echo "  Fichier : $fileDossier \r\n";

                       }else {
                        echo "          Fichier : $fileDossier \r\n";
                       }
                   }
                   
                }
               
            }
       }
    }
}

//////////////// Algo Principal ///////////////////

$file = 'C:\_xampp\htdocs\www\10_-_La_gestion_de_fichiers_-_Arborescence\arborescence_test' ;


if (is_dir($file)){
    if($root = opendir($file)){
        while (($fileRoot = readdir($root)) !== false) {

            if (is_dir($root . '/' . $fileRoot) && $fileRoot !== '.' && $fileRoot !== '..' ) 
                
                echo "Dossier : $fileRoot \r\n";

                ParcourDossier($fileRoot, 0);            
        }
    }
    closedir($root);
}