<?php
/**
 * ------------------------------------------------------------
 * PAGES CONTROLLER
 * (Requires : KernelException | PostsController)
 * ------------------------------------------------------------
**/
class PagesController extends PostsController {
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

            $this->setModel();
            $this->getview()->terms = $this->getModel()->getStatus();
            $this->getview()->access = $this->getModel()->getAccess();         
            $this->getview()->parents = $this->getModel()->get();



            $this->render( FALSE, 'Admin' . DS . $this->getAction(), 'Admin' . DS . 'main' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not render the <strong>' . $this->getAction() . '</strong> view in  <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }
    /**
     * addingAction - Adds a posts - No Parents = parents = 1
     * @param
     * @return
    **/
    public function addingAction() {
        $this->init( __FUNCTION__ );
     
      
        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !$this->getModAuth()->getUser()->can('create_pages' ) )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );
        //    var_dump($this->getRequest()->post());
            if( self::isRequiredPassed( array( 'title', 'content', 'excerpt', 'status', 'access', 'parent' ), $this->getRequest()->post() ) ) :
                $this->setModel();
                
                if( $this->getModel()->add( $this->getRequest()->post(),$this->getModAuth()->getUser()->getEmail() ) ) :

                    NavigationManagement::redirect( DOMAIN . 'pages/list/?_err=ok' );
                endif;
            else :
                NavigationManagement::redirect( DOMAIN . 'pages/add/?_err=required' );
            endif;

            NavigationManagement::redirect( DOMAIN . 'pages/add/?_err=error' );

        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not applying the <strong>' . $this->getAction() . '</strong> action in <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
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

                $this->setModel();
                $out = $this->getModel()->get( NavigationManagement::walks()[2] );
                if( empty( $out->getId() ) )
                    NavigationManagement::redirect( DOMAIN . 'pages/' );
    
                $this->getView()->sitename = _( 'Edit page' );
                $this->getview()->terms = $this->getModel()->getStatus();
                $this->getview()->access = $this->getModel()->getAccess();         
                $this->getview()->parents = $this->getModel()->get();
                $this->getView()->posts = $out;
        
            $this->render( FALSE, 'Admin' . DS . $this->getAction(), 'Admin' . DS . 'main' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not render the <strong>' . $this->getAction() . '</strong> view in  <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }


    /**
     * updatingAction - Updates the user's profile
     * @param
     * @return
    **/
    public function updatingAction() {
        $this->init( __FUNCTION__ );

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( self::isRequiredPassed( array( 'title', 'content', 'excerpt', 'status', 'access', 'parent' ), $this->getRequest()->post() ) ) : 
                $this->setModel();
                if( $this->getModel()->edit(NavigationManagement::walks()[2],$this->getRequest()->post() ) ):
        
                    NavigationManagement::redirect( DOMAIN . 'pages/' . ( count( NavigationManagement::walks() )>2 ? 'edit/' . NavigationManagement::walks()[2] : 'pages' ) . '/?_err=ok' );
                endif;
            else :
                NavigationManagement::redirect( DOMAIN . 'pages/' . ( count( NavigationManagement::walks() )>2 ? 'edit/' . NavigationManagement::walks()[2] : 'pages' ) . '/?_err=required' );
            endif;

            NavigationManagement::redirect( DOMAIN . 'pages/' . ( count( NavigationManagement::walks() )>2 ? 'edit/' . NavigationManagement::walks()[2] : 'pages' ) . '/?_err=error' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not applying the <strong>' . $this->getAction() . '</strong> action in <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }


}