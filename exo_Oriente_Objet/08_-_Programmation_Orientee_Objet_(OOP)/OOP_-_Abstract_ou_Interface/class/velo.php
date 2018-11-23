<?php 

class velo extends vehicle implements I_embarquer {
    public function se_deplacer(){
        echo 'Pédale Jean Mi !!! pédale !';
    }

    function charger(  $objets){
   
        echo "j'ai chargé dans ma remorque : ". $objets; 
    }
    function decharger( array $objets) {

        echo "j'ai déchargé dansma remorque : ". $objets; 
    }
}