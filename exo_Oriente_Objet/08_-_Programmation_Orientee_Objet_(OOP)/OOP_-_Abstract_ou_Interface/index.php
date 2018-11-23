<?php 


function Load_Class($class){
    if(file_exists("class/".$class.".php")){
        require_once("class/".$class.".php");
    }

}

spl_autoload_register('Load_Class');

$key= 'je suis la clé';
$telecomande ='Tééééééééééléééééééééééécommande !! :D ';

$velo= new velo();
$voiture= new voiture();
$camion_benne= new camion_benne();

$velo->se_deplacer();
$voiture->se_deplacer();
$camion_benne->se_deplacer();

$camion_benne->Ouvrir_le_vehicule($key);
$voiture->Ouvrir_le_vehicule($telecomande);


