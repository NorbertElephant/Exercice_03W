<?php

class MessageController {


    public function ListMessage( SRequest  $request){
        try{

        $message_model = new MessageModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());

        // Gestion Si la conversation exist
        $valid_id = $message_model->is_exist_id(SRequest::getInstance()->get('id'));
        if($valid_id === false) {
            header('Location: 404.php');
            exit;
        } else {
            // Gestion User S'il existe
            $user_controller = new UserController();
            $user = $user_controller->Connect($request);
            if ( $user === false ) {
                $login_empty= '<p style="background-color:#ff0000"> Veuillez saisir un login / Ou un login Valide </p>';
            }
          
            // Gestion Tri
            if ($request->post('Tri') !== null)  {
                $messages = $message_model->Read($request->get('id'), $request->get('page') ,$request->post('Tri'));
            } else{
                $messages = $message_model->Read($request->get('id'), $request->get('page'));
            }
        }

        // Gestion Pagination 
        if ($_SESSION[APP_TAG]['page'] !== NULL) {
            if ($request->get('page')> ($_SESSION[APP_TAG]['page'] -1 )) {
                header('Location: 404.php');
                exit;
            }
        }
        
        $nbr_page = $messages[0]->get_numbers()/20;
        $_SESSION[APP_TAG]['page']=$nbr_page;
        $affichage_page= pagination($nbr_page,$request->get('id'));

        include('./Views/User/User.php');
        include('./Views/Message/ListingMessages.php');

        } catch(PDOException $e){
            throw new Exception ($e->getMessage(),$e->getCode(),$e);
        }

    }


    public function CreateMessage( SRequest  $request, $user) {
        try{
            $message_model = new MessageModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO());

            if($request->post('contenu') !== NULL) {
                $message_create = $message_model->CreateMessage($request->post('contenu'),date('Y-m-d H:m:s'),$user->get_id(),$request->get('id'));
                
            }

            $this->ListMessage($request);
            
        } catch(PDOException $e){
            throw new Exception ($e->getMessage(),$e->getCode(),$e);
        }
    }


}