<?php

class AccueilController {

    public function Accueil() {
        try{
            $nain_model= new NainModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $nains = $nain_model->ReadAll();

            $groupe_model= new GroupeModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $groupes = $groupe_model->ReadAll();

            $taverne_model= new TaverneModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $tavernes = $taverne_model->ReadAll();

            $ville_model= new VilleModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $villes = $ville_model->ReadAll();

            include('./Views/accueil.php');
        } catch(PDOException $e){
            throw new Exception ($e->getMessage(),$e->getCode(),$e);
        }
    }
   
}