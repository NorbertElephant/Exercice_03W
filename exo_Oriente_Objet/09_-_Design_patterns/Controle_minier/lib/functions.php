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