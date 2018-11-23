<?php 

class voiture extends vehicle implements I_Ouvrir_vehicle{

    public function se_deplacer(){
        echo 'Voiture qui se déplace !';
    }

    public function Ouvrir_le_vehicule($moyen){
        echo "J'ouvre ma voiture avec : ".$moyen; 
    }
}