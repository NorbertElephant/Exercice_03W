<?php 

class camion_benne extends vehicle implements I_embarquer,I_ouvrir_vehicle {

    public function se_deplacer(){
        echo 'Le camion se déplace YOUhouuuuuuuuuuuu ';
    }

    public function Ouvrir_le_vehicule($moyen){

        echo "J'ouvre ma voiture avec : ".$moyen; 
    }

    function charger(  $objets){


        echo "j'ai chargé dans mon camion : ". $objets; 
    }
    function decharger( array $objets) {
    
        echo "j'ai déchargé dans mon camion : ". $objets; 
    }
}