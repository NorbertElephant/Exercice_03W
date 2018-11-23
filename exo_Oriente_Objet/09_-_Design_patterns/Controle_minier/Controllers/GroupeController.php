<?php

class GroupeController {

    public function ListAll(){
        try{
            $groupe_model= new GroupeModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $groupes = $groupe_model->ReadAll();
            include('./Views/groupe/ListGroups.php');
        } catch(PDOException $e){
            throw new Exception ($e->getMessage(),$e->getCode(),$e);
        }
       
    }


    public function CardGroupe($id){
        try{
            $groupe_model= new GroupeModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $groupe = $groupe_model->ReadOne($id); // Récupérer le groupe 

            $nain_model= new NainModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $nains = $nain_model->ReadByGroups($groupe->get_id()); // Récupérer les Nains du groupe 

            $tunnel_model= new TunnelModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $tunnel = $tunnel_model->ReadByGroup($groupe->get_tunnel_fk()); // Récupérer les Tunnels de la ville 

            $taverne_model= new TaverneModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $taverne = $taverne_model->ReadOne($groupe->get_taverne_fk()); // Récupérer la taverne du groupe
           

            include('./Views/groupe/CardGroup.php');
        } catch(PDOException $e){
            throw new Exception ($e->getMessage(),$e->getCode(),$e);
        }
    }
}