<?php
/**
 * ------------------------------------------------------------
 * ADMIN CONTROLLER
 * (Requires : NavigationManagement | KernelException | KernelController)
 * ------------------------------------------------------------
**/
class AdminController extends KernelController {
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

        try {
            if( $this->isAuthentified() )
                if( $this->getModAuth()->getUser()->can( 'edit_dashboard' ) )
                    NavigationManagement::redirect( DOMAIN . 'admin/dashboard/' );
                else
                    NavigationManagement::redirect( DOMAIN . 'users/profile/' );

            $this->getView()->sitename = _( 'Login form' );

            $this->render( $this->getCaching() );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not render the <strong>' . $this->getAction() . '</strong> view in  <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }

    /**
     * logoutAction -
     * @param
     * @return
    **/
    public function logoutAction() {
        $this->init( __FUNCTION__ );

        try {
            NavigationManagement::redirect( DOMAIN . 'users/logout/' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not render the <strong>' . $this->getAction() . '</strong> view in  <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }

    /**
     * dashboardAction - Displays the dashboard view
     * @param
     * @return
    **/
    public function dashboardAction() {
        $this->init( __FUNCTION__ );

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !$this->getModAuth()->getUser()->can( 'edit_dashboard' ) )
                NavigationManagement::redirect( DOMAIN . 'users/profile/' );

            $this->getView()->sitename = _( 'Dashboard' );

            $this->render( FALSE, 'Admin' . DS . $this->getAction(), 'Admin' . DS . 'main' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not render the <strong>' . $this->getAction() . '</strong> view in  <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }
}