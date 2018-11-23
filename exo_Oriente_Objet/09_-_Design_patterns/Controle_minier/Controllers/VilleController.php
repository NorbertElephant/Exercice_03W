<?php

class VilleController {

    public function ListAll(){
        try{
            $ville_model= new VilleModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $villes = $ville_model->ReadAll();
            include('./Views/ville/ListVilles.php');
        } catch(PDOException $e){
            throw new Exception ($e->getMessage(),$e->getCode(),$e);
        }
       
    }
    public function CardVille($id){
        try{
            $ville_model= new VilleModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $ville = $ville_model->ReadOne($id); // Récupérer la Ville 

            $nain_model= new NainModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $nains = $nain_model->ReadByVille($ville->get_id()); // Récupérer les Nains de la ville 

            $taverne_model= new TaverneModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $tavernes = $taverne_model->ReadByVille($ville->get_id()); // Récupérer les Tavernes de la ville 

            $tunnel_model= new TunnelModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $tunnels = $tunnel_model->ReadByVille($ville->get_id()); // Récupérer les Tunnels de la ville 

            foreach ($tunnels as $key => $value) {
                if ($value->get_villearrivee_fk() == $ville->get_id()) {
                    $villedepart = $ville_model->ReadOne($value->get_villedepart_fk());
                    $value->set_nom_villedepart($villedepart->get_nom());
                }
            }
            
            include('./Views/ville/CardVille.php');
        } catch(PDOException $e){
            throw new Exception ($e->getMessage(),$e->getCode(),$e);
        }
       
    }



}