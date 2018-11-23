<?php

class NainController {

    public function ListAll(){
        try{
            $nain_model= new NainModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $nains = $nain_model->ReadAll();
            include('./Views/nain/ListNains.php');
        } catch(PDOException $e){
            throw new Exception ($e->getMessage(),$e->getCode(),$e);
        }
       
    }


    public function CardNain($id){
        try{
            $nain_model= new NainModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $nain = $nain_model->ReadOne($id); // Récupérer les Nains de la ville 

            $groupe_model= new GroupeModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $group = $groupe_model->ReadAll(); // Récupérer Groupes 

                   
            include('./Views/nain/CardNain.php');
        } catch(PDOException $e){
            throw new Exception ($e->getMessage(),$e->getCode(),$e);
        }
       
    }

    public function UpdateNain($id){
        try{
            $nain_model= new NainModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $Update = $nain_model->UpdateNainGroupe(SRequest::getInstance()->get('nain'),SRequest::getInstance()->post() ); // Modifictation du groupe
            $nain = $nain_model->ReadOne($id); // Récupérer les Nains de la ville 

            $groupe_model= new GroupeModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $group = $groupe_model->ReadAll(); // Récupérer Groupes 
            
                   
            include('./Views/nain/CardNain.php');
        } catch(PDOException $e){
            throw new Exception ($e->getMessage(),$e->getCode(),$e);
        }
       
    }

 
}