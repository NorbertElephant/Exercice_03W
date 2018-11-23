<?php
/**
 * ------------------------------------------------------------
 * PAGES CONTROLLER
 * (Requires : KernelException | PostsController)
 * ------------------------------------------------------------
**/
class PortfolioController extends PagesController {
    /**
     * --------------------------------------------------
     * ACTIONS
     * --------------------------------------------------
    **/
    /**
     * defaultAction - Displays the default view
     * @param
     * @return
    **/
    public function defaultAction() {
        $this->init( __FUNCTION__ );
        
        $this->render( $this->getCaching() );
    
    }
  
}