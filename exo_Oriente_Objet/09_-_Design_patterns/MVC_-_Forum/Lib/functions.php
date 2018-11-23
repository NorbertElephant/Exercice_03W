<?php
function Load_Classes($class){
    if(file_exists("Classes/".$class.".php")){
        require_once("Classes/".$class.".php");
    }
}

function Load_Controllers($class){
    if(file_exists("Controllers/".$class.".php")){
        require_once("Controllers/".$class.".php");
    }
}

function Load_Models($class){
    if(file_exists("Models/".$class.".php")){
        require_once("Models/".$class.".php");
    }
}



spl_autoload_register('Load_Classes');
spl_autoload_register('Load_Controllers');
spl_autoload_register('Load_Models');




function pagination($nbr_page, $id){
    $str='';
    for ($i=1; $i <= $nbr_page-1; $i++) { 
        $str .= '<a href="?c=message&id='.$id.'&page='.$i.'"> '.$i.'</a>';
   }
   return $str;
}

function ShowPage($page,  $affichage_page,$id, $nbr_page) {
    if ($page == 1) {
        echo 'Pages : '.$affichage_page.'<a href="?c=message&id='.$id.'&page='.($page+1).'"> Suivant</a> ';
    }else {
        if ($page > 1  && $page < ($nbr_page-2)) {
            echo 'Pages :<a href="?c=message&id='.$id.'&page='.($page-1).'"> Précedent</a>'.$affichage_page.'<a href="?c=message&id='.$id.'&page='.($page+1).'"> Suivant</a> ';
        }else{
            echo 'Pages :<a href="?c=messageid='.$id.'&page='.($page-1).'"> Précedent</a>'.$affichage_page;
        } 
    } 

}

