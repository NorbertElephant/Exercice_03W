<?php

class TaverneController {

    public function ListAll(){
        try{
            $taverne_model= new TaverneModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $tavernes = $taverne_model->ReadAll();
            include('./Views/taverne/ListTavernes.php');
        } catch(PDOException $e){
            throw new Exception ($e->getMessage(),$e->getCode(),$e);
        }
       
    }
    public function CardTaverne($id){
        try{
            $taverne_model= new TaverneModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $taverne = $taverne_model->ReadOne($id);
            include('./Views/taverne/CardTaverne.php');
        } catch(PDOException $e){
            throw new Exception ($e->getMessage(),$e->getCode(),$e);
        }
       
    }
}