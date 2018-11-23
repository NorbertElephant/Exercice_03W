<?php
/**
 * ------------------------------------------------------------
 * PAGES CONTROLLER
 * (Requires : KernelException | PostsController)
 * ------------------------------------------------------------
**/
class ServicesController extends PostsController {
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

    /**
     * contactAction - Displays the contact view
     * @param
     * @return
    **/
    public function contactAction() {
        $this->init( __FUNCTION__ );

        $this->render( $this->getCaching() );
    }

    /**
     * listAction - Displays the pages list view
     * @param
     * @return
    **/
    public function listAction() {
        $this->init( __FUNCTION__ );

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !$this->getModAuth()->getUser()->can( 'edit_pages' ) )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            $this->setModel();
            foreach( $this->getModel()->get() as $page ) :
                $out =  ( isset( $out ) ? $out : '' ) . '
                        <li class="page" data-author="' . $page->getAuthor() . '" data-releasedate="' . $page->getReleaseDate() . '">
                            ' . ( $this->getModAuth()->getUser()->can( 'edit_pages' ) ? '<a href="' . DOMAIN . 'pages/edit/' . $page->getId() . '" title="' . $page->getTitle() . '">' : '' ) . '
                                <h2>' . $page->getTitle() . '</h2>
                            ' . ( $this->getModAuth()->getUser()->can( 'edit_pages' ) ? '</a>' : '' ) . '
                        </li>';
            endforeach;

            $this->getView()->sitename = _( 'Pages list' );
            $this->getView()->list = '<ul id="list">' . ( isset( $out ) ? $out : '' ) . '</ul>';

            $this->render( FALSE, 'Admin' . DS . $this->getAction(), 'Admin' . DS . 'main' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not render the <strong>' . $this->getAction() . '</strong> view in  <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }

    /**
     * addAction - Displays the page add's view
     * @param
     * @return
    **/
    public function addAction() {
        $this->init( __FUNCTION__ );

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !$this->getModAuth()->getUser()->can( 'edit_pages' ) )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            $this->getView()->sitename = _( 'Add new page' );

            $this->render( FALSE, 'Admin' . DS . $this->getAction(), 'Admin' . DS . 'main' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not render the <strong>' . $this->getAction() . '</strong> view in  <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }

    /**
     * editAction - Displays the page edit view
     * @param
     * @return
    **/
    public function editAction() {
        $this->init( __FUNCTION__ );

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !$this->getModAuth()->getUser()->can( 'edit_pages' ) )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            $this->getView()->sitename = _( 'Edit page' );

            $this->render( FALSE, 'Admin' . DS . $this->getAction(), 'Admin' . DS . 'main' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not render the <strong>' . $this->getAction() . '</strong> view in  <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }
}