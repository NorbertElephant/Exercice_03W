<?php

require_once('./lib/functions.php');
require_once('./ini.php');

if (SRequest::getInstance()->get('c') == 'Nain') {
    $controller = new NainController;

    if (SRequest::getInstance()->get('nain')) {
        if (SRequest::getInstance()->post('Update')) {
            $controller->UpdateNain(SRequest::getInstance()->get('nain'));
        } else {
            $controller->CardNain(SRequest::getInstance()->get('nain'));
        } 
    } else {
        $controller->ListAll();
    }
} elseif (SRequest::getInstance()->get('c') == 'Taverne') {
    $controller = new TaverneController;

    if (SRequest::getInstance()->get('taverne')) {
        $controller->CardTaverne(SRequest::getInstance()->get('taverne'));
    } else {
        $controller->ListAll();
    }

} elseif (SRequest::getInstance()->get('c') == 'Ville') {
    $controller = new VilleController;
    
    if (SRequest::getInstance()->get('ville')) {
        $controller->CardVille(SRequest::getInstance()->get('ville'));
    } else {
        $controller->ListAll();
    }
} elseif (SRequest::getInstance()->get('c') == 'Groupe') {
    $controller = new GroupeController;

    if (SRequest::getInstance()->get('groupe')) {
        $controller->CardGroupe(SRequest::getInstance()->get('groupe'));
    } else {
        $controller->ListAll();
    }
}else  {
    $controller = new AccueilController; 
    $controller->Accueil();
}

