<?php
require_once('./lib/functions.php');
require_once('./ini.php');


if(SRequest::getInstance()->get('del') !== NULL ) {
    if(isset($_SESSION[APP_TAG]['user'] ) ) {
        unset($_SESSION[APP_TAG]['user']);
        header('Location:.');
        exit;
    }
}

$controller = new ConversationController;

if (SRequest::getInstance()->get('c') == 'conversation') {

    $controller->listAll();

} elseif (SRequest::getInstance()->get('c') == 'user') {

    $controller = new UserController;

    $controller->CreateUser(SRequest::getInstance());

} elseif (SRequest::getInstance()->get('c') == 'message'){

    $controller = new MessageController;

    if (SRequest::getInstance()->get('id') !== NULL && SRequest::getInstance()->get('page') !== NULL) {
     

        if (SRequest::getInstance()->post('contenu') !== NULL ) {
            $user = User();
            $controller->CreateMessage(SRequest::getInstance(), $user);
        } else {
            $controller->ListMessage(SRequest::getInstance());
        }
    }

}  else {
    $controller->listAll(SRequest::getInstance());
}





?>
    
