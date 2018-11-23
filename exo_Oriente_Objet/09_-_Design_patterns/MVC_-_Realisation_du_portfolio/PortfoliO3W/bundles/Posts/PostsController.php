<?php
/**
 * ------------------------------------------------------------
 * POSTS CONTROLLER
 * (Requires : KernelException | KernelController)
 * ------------------------------------------------------------
**/
class PostsController extends KernelController {
    use NavigationManagement, Form;
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
     * manageCategoriesAction - Displays the categories list view
     * @param
     * @return
    **/
    public function manageCategoriesAction() {
        $this->init( __FUNCTION__ );

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !$this->getModAuth()->getUser()->can( 'manage_categories' ) )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            $this->setModel();
        
            foreach( $this->getModel()->getCategories() as $categorie ) :
                $out =  ( isset( $out ) ? $out : '' ) . '
                        <li class="category">
                            ' . ( $this->getModAuth()->getUser()->can( 'edit_posts' ) ? '<a href="' . DOMAIN . 'posts/edit-category/' . $categorie->getId() . '" title="' . $categorie->getTitle() . '">' : '' ) . '
                                <h2>' . $categorie->getTitle() . '</h2>
                            ' . ( $this->getModAuth()->getUser()->can( 'edit_posts' ) ? '</a>' : '' ) . '
                        </li>';
            endforeach;

            $this->getView()->sitename = _( 'Categories list' );
            $this->getView()->list = '<ul id="list">' . ( isset( $out ) ? $out : '' ) . '</ul>';

            $this->render( FALSE, 'Admin' . DS . $this->getAction(), 'Admin' . DS . 'main' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not render the <strong>' . $this->getAction() . '</strong> view in  <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }

    /**
     * addCategoryAction - Displays the category add's view
     * @param
     * @return
    **/
    public function addCategoryAction() {
        $this->init( __FUNCTION__ );

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !$this->getModAuth()->getUser()->can( 'manage_categories' ) )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            $this->getView()->sitename = _( 'Add new category' );
            $this->setModel();
            $this->getview()->terms = $this->getModel()->getStatus();
            $this->getview()->access = $this->getModel()->getAccess(); 
            $this->getview()->formats = $this->getModel()->getFormat();         
            $this->getview()->parents = $this->getModel()->get();

            $this->render( FALSE, 'Admin' . DS . $this->getAction(), 'Admin' . DS . 'main' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not render the <strong>' . $this->getAction() . '</strong> view in  <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }
      /**
     * addingAction - Adds a posts
     * @param
     * @return
    **/
    public function addingCategoryAction() {
        $this->init( __FUNCTION__ );
      

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !$this->getModAuth()->getUser()->can( 'create_post' ) )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( self::isRequiredPassed( array( 'title', 'content', 'excerpt', 'type', 'status', 'access', 'format', 'parent' ), $this->getRequest()->post() ) ) :
                $this->setModel();
                
                if( $this->getModel()->add( $this->getRequest()->post(),$this->getModAuth()->getUser()->getEmail() ) ) :

                    NavigationManagement::redirect( DOMAIN . 'posts/manageCategories/?_err=ok' );
                endif;
            else :
                NavigationManagement::redirect( DOMAIN . 'posts/addCategory/?_err=required' );
            endif;

            NavigationManagement::redirect( DOMAIN . 'posts/addCategory/?_err=error' );

        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not applying the <strong>' . $this->getAction() . '</strong> action in <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }

    /**
     * editCategoryAction - Displays the category edit view
     * @param
     * @return
    **/
    public function editCategoryAction() {
        $this->init( __FUNCTION__ );

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !$this->getModAuth()->getUser()->can( 'manage_categories' ) )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );
                
            $this->setModel();
            $out = $this->getModel()->getCategories( NavigationManagement::walks()[2] );
            
            $this->getView()->sitename = _( 'Edit category' );
           
            $this->getview()->terms = $this->getModel()->getStatus();
            $this->getview()->access = $this->getModel()->getAccess(); 
            $this->getview()->formats = $this->getModel()->getFormat();         
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
    public function updatingCategoryAction() {
        $this->init( __FUNCTION__ );

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( self::isRequiredPassed( array( 'title', 'content', 'excerpt', 'status', 'access', 'parent' ), $this->getRequest()->post() ) ) : 
                $this->setModel();
                if( $this->getModel()->edit(NavigationManagement::walks()[2],$this->getRequest()->post() ) ):
        
                    NavigationManagement::redirect( DOMAIN . 'posts/' . ( count( NavigationManagement::walks() )>2 ? 'edit-category/' . NavigationManagement::walks()[2] : 'posts' ) . '/?_err=ok' );
                endif;
            else :
                NavigationManagement::redirect( DOMAIN . 'posts/' . ( count( NavigationManagement::walks() )>2 ? 'edit-category/' . NavigationManagement::walks()[2] : 'posts' ) . '/?_err=required' );
            endif;

            NavigationManagement::redirect( DOMAIN . 'posts/' . ( count( NavigationManagement::walks() )>2 ? 'edit/' . NavigationManagement::walks()[2] : 'posts' ) . '/?_err=error' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not applying the <strong>' . $this->getAction() . '</strong> action in <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }


    /**
     * listAction - Displays the posts list view
     * @param
     * @return
    **/
    public function listAction() {
        $this->init( __FUNCTION__ );

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !$this->getModAuth()->getUser()->can( 'edit_posts' ) )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            $this->setModel();
            foreach( $this->getModel()->get() as $post ) :
                $out =  ( isset( $out ) ? $out : '' ) . '
                        <li class="post" data-author="' . $post->getAuthor() . '" data-releasedate="' . $post->getReleaseDate() . '">
                            ' . ( $this->getModAuth()->getUser()->can( 'edit_posts' ) ? '<a href="' . DOMAIN . 'posts/edit/' . $post->getId() . '" title="' . $post->getTitle() . '">' : '' ) . '
                                <h2>' . $post->getTitle() . '</h2>
                            ' . ( $this->getModAuth()->getUser()->can( 'edit_posts' ) ? '</a>' : '' ) . '
                        </li>';
            endforeach;

            $this->getView()->sitename = _( 'Posts list' );
            $this->getView()->list = '<ul id="list">' . ( isset( $out ) ? $out : '' ) . '</ul>';

            $this->render( FALSE, 'Admin' . DS . $this->getAction(), 'Admin' . DS . 'main' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not render the <strong>' . $this->getAction() . '</strong> view in  <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }

    /**
     * addAction - Displays the post add's view
     * @param
     * @return
    **/
    public function addAction() {
        $this->init( __FUNCTION__ );
        $user = unserialize($_SESSION[APP_TAG]['auth']);
        $user = new ClassUser($user);

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !$this->getModAuth()->getUser()->can( 'edit_posts' ) )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            $this->setModel();
            $this->getView()->sitename = _( 'Add new post' );
             
            $this->getview()->terms = $this->getModel()->getStatus();
            $this->getview()->access = $this->getModel()->getAccess(); 
            $this->getview()->formats = $this->getModel()->getFormat();         
            $this->getview()->parents = $this->getModel()->getCategories();
           
           
            
            $this->render( FALSE, 'Admin' . DS . $this->getAction(), 'Admin' . DS . 'main' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not render the <strong>' . $this->getAction() . '</strong> view in  <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }

   /**
     * addingAction - Adds a posts
     * @param
     * @return
    **/
    public function addingAction() {
        $this->init( __FUNCTION__ );
        
        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !$this->getModAuth()->getUser()->can( 'create_post' ) )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( self::isRequiredPassed( array( 'title', 'content', 'excerpt', 'type', 'status', 'access', 'format', 'parent' ), $this->getRequest()->post() ) ) :
                $this->setModel();
                
                if( $this->getModel()->add( $this->getRequest()->post(),$this->getModAuth()->getUser()->getEmail() ) ) :

                    NavigationManagement::redirect( DOMAIN . 'posts/list/?_err=ok' );
                endif;
            else :
                NavigationManagement::redirect( DOMAIN . 'posts/add/?_err=required' );
            endif;

            NavigationManagement::redirect( DOMAIN .'posts/add/?_err=error' );

        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not applying the <strong>' . $this->getAction() . '</strong> action in <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }
  

/**
     * editAction - Displays the post edit view
     * @param
     * @return
    **/
    public function editAction() {
        $this->init( __FUNCTION__ );

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !$this->getModAuth()->getUser()->can( 'edit_posts' ) )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            $this->setModel();
            $out = $this->getModel()->get( NavigationManagement::walks()[2] );
            
            $this->getView()->sitename = _( 'Edit post' );
            
            $this->getview()->terms = $this->getModel()->getStatus();
            $this->getview()->access = $this->getModel()->getAccess(); 
            $this->getview()->formats = $this->getModel()->getFormat();         
            $this->getview()->parents = $this->getModel()->getCategories();
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
        
                    NavigationManagement::redirect( DOMAIN . 'posts/' . ( count( NavigationManagement::walks() )>2 ? 'edit/' . NavigationManagement::walks()[2] : 'posts' ) . '/?_err=ok' );
                endif;
            else :
                NavigationManagement::redirect( DOMAIN . 'posts/' . ( count( NavigationManagement::walks() )>2 ? 'edit/' . NavigationManagement::walks()[2] : 'posts' ) . '/?_err=required' );
            endif;

            NavigationManagement::redirect( DOMAIN . 'posts/' . ( count( NavigationManagement::walks() )>2 ? 'edit/' . NavigationManagement::walks()[2] : 'posts' ) . '/?_err=error' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not applying the <strong>' . $this->getAction() . '</strong> action in <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }
    
}