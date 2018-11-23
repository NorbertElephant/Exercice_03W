<?php 

class UserController {

        
    public function CreateUser( SRequest $request ){
        try{
            if ($request->post('login') !== NULL ) {
                $user_model = new userModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO()); 
                $create_account = $user_model->CreateAccount($request->post('login'),$request->post('prenom') ,$request->post('nom'), $request->post('login'), date('Y-m-d h:m:s') );
            }
            

            return include('./Views/User/CreateUser.php');


        } catch(PDOException $e){
            throw new Exception ($e->getMessage(),$e->getCode(),$e);
        }
    
    }

    public function Connect( SRequest $request) {
        if (isset($_SESSION[APP_TAG]['user'])) {
            return $user = unserialize($_SESSION[APP_TAG]['user']);
        }
        if( $request->post('login') !== NULL ){
            if($request->post('login') == '' ){
                return false;
            
            }else {
                $user_model = new userModel(SPDO::getInstance(DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO()); 
                $user = $user_model->connect($request->post()); // Connection bon et reception de L'objet USER 
                if ($user === false) {
                    return false;
                }
                $_SESSION[APP_TAG]['user'] = serialize($user);
                return $user;
            }
        }
    }
        
}