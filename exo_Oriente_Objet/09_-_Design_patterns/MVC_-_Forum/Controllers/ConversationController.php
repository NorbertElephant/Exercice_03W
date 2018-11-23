<?php

class ConversationController {

        
    public function ListAll(SRequest $request){
        try{
            $conversation_model= new ConversationModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());
            $conversations = $conversation_model->ReadAll();

            if (isset($_SESSION[APP_TAG]['user'])) {
                $user = unserialize($_SESSION[APP_TAG]['user']);
            }
            
            // Gestion User S'il existe
            $user_controller = new UserController();
            $user = $user_controller->Connect($request);
            if ( $user === false ) {
                $login_empty= '<p style="background-color:#ff0000"> Veuillez saisir un login / Ou un login Valide </p>';
            }
               
            include('./Views/User/User.php');
            include('./Views/Conversation/ListingConversations.php');

        } catch(PDOException $e){
            throw new Exception ($e->getMessage(),$e->getCode(),$e);
        }
       
    }





}