<?php
/**
 * ------------------------------------------------------------
 * USERS CONTROLLER
 * (Requires : Form | NavigationManagement | KernelException | KernelController)
 * ------------------------------------------------------------
**/
class UsersController extends KernelController {
    use NavigationManagement, Form;

    /**
     * --------------------------------------------------
     * CONSTANTS
     * --------------------------------------------------
    **/
    const ORDER_BY_POWER = 'power';
    const ORDER_BY_DENOMINATION = 'denomination';

    /**
     * --------------------------------------------------
     * ACTIONS
     * --------------------------------------------------
    **/
    /**
     * defaultAction - Displays the default view complemented by its data
     * @param
     * @return
    **/
    public function defaultAction() {
        $this->init( __FUNCTION__ );

        try {
            if( $this->isAuthentified() ) :
                if( !$this->getModAuth()->getUser()->can( 'list_users' ) )
                    NavigationManagement::redirect( DOMAIN . 'error/403/' );

                $this->setModel();
                foreach( $this->getModel()->getUserByRole() as $user ) :
                    $out =  ( isset( $out ) ? $out : '' ) . '
                            <li class="user" data-lastconnection="' . $user->getLastConnectionDate() . '" data-registration="' . $user->getRegistrationDate() . '" data-role="' . $user->getRole( 'keyword' ) . '">
                                ' . ( $this->getModAuth()->getUser()->can( 'edit_users' ) ? '<a href="' . DOMAIN . 'users/edit/' . $user->getEmail() . '" title="' . $user->getFirstname() . ' ' . $user->getLastname() . '">' : '' ) . '
                                    ' . $user->avatar() . '
                                    <h2>' . $user->getFirstname() . ' ' . $user->getLastname() . '</h2>
                                    <h3>' . self::translate( $user->getRole( 'denomination' ), ( $this->getRequest()->get( 'lang' )!==NULL ? $this->getRequest()->get( 'lang' ) : ISO_LANGUAGE_CODE ) ) . '</h3>
                                ' . ( $this->getModAuth()->getUser()->can( 'edit_users' ) ? '</a>' : '' ) . '
                            </li>';
                endforeach;

                $this->getView()->sitename = _( 'Users list' );
                $this->getView()->list = '<ul id="list">' . ( isset( $out ) ? $out : '' ) . '</ul>';

                $this->render( FALSE, 'Admin' . DS . $this->getAction(), 'Admin' . DS . 'main' );
            else :
                $this->getView()->sitename = _( 'Login form' );

                $this->render( $this->getCaching() );
            endif;
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not render the <strong>' . $this->getAction() . '</strong> view in  <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }

    /**
     * loginAction -
     * @param
     * @return
    **/
    public function loginAction() {
        $this->init( __FUNCTION__ );

        try {
            $this->setModel();
            if( $this->getRequest()->post( 'login' )!==NULL && ( $token = $this->getModel()->isAuthMatch( $this->getRequest()->post() ) )!==FALSE )
                if( !empty( $token ) ) :
                    $this->getModAuth()->login( $this->getModel()->getUserByToken( $token ) );
                    NavigationManagement::redirect( DOMAIN . 'users/profile/' );
                endif;

            NavigationManagement::redirect( DOMAIN . substr( ( !empty( $_SERVER['HTTP_REFERER'] ) ? NavigationManagement::requestUri( $_SERVER['HTTP_REFERER'] ) : $_SERVER['REQUEST_URI'] ), strlen( NavigationManagement::requestUri() ) ) . '?_err=login' );
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
            $this->setModel();
            $this->getModAuth()->logout();

            NavigationManagement::redirect( DOMAIN );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not render the <strong>' . $this->getAction() . '</strong> view in  <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }

    /**
     * addAction - Displays the add user view
     * @param
     * @return
    **/
    public function addAction() {
        $this->init( __FUNCTION__ );

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !$this->getModAuth()->getUser()->can( 'create_users' ) )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            $this->setModel();
            $out = $this->formatRoles( $this->getModel()->getRole(), 'subscriber' );

            $this->getView()->sitename = _( 'Add user' );
            $this->getView()->roles = $out;

            $this->render( FALSE, 'Admin' . DS . $this->getAction(), 'Admin' . DS . 'main' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not render the <strong>' . $this->getAction() . '</strong> view in  <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }

    /**
     * addingAction - Adds a user
     * @param
     * @return
    **/
    public function addingAction() {
        $this->init( __FUNCTION__ );

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !$this->getModAuth()->getUser()->can( 'create_users' ) )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( self::isRequiredPassed( array( 'email', 'password', 'passwordconfirm', 'firstname', 'lastname', 'role' ), $this->getRequest()->post() ) ) :
                $this->setModel();
                if( $this->getRequest()->files( 'avatar' )!==NULL && !empty( $this->getRequest()->files( 'avatar' )['tmp_name'] ) && $this->getRequest()->files( 'avatar' )['size']>0 ) :
                    $upload_dir = UPLOADSPATH . 'avatars' . DS . date( 'Y' ) . DS . date( 'm' ) . DS;
                    if( ( $file = ClassUser::upload( $this->getRequest()->files( 'avatar' ), $upload_dir ) )!==FALSE )
                        if( ( $avatar = $this->getModel()->avatarCreate( $this->getRequest()->post( 'email' ), $file['filename'], $this->getRequest()->post( 'firstname' ) . ' ' . strtoupper( $this->getRequest()->post( 'lastname' ) ), $this->getRequest()->files( 'avatar' )['type'], $file['currenttimestamp'] ) )===FALSE )
                            NavigationManagement::redirect( DOMAIN . 'users/add/?_err=avatar' );
                endif;

                if( $this->getModel()->add( $this->getRequest()->post(), ( isset( $avatar ) ? $avatar : NULL ) ) ) :
                    NavigationManagement::redirect( DOMAIN . 'users/edit/' . $this->getRequest()->post( 'email' ) . '/?_err=ok' );
                endif;
            else :
                NavigationManagement::redirect( DOMAIN . 'users/add/?_err=required' );
            endif;

            NavigationManagement::redirect( DOMAIN . 'users/add/?_err=error' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not applying the <strong>' . $this->getAction() . '</strong> action in <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }

    /**
     * profileAction - Displays the profile view complemented by its data
     * @param
     * @return
    **/
    public function profileAction() {
        $this->init( __FUNCTION__ );

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            $this->setModel();
            $out = $this->formatRoles( $this->getModel()->getRole(), $this->getModel()->getRoleByToken( $this->getModAuth()->getUser()->getToken() )['keyword'] );

            $this->getView()->sitename = _( 'Profile' );
            $this->getView()->roles = $out;

            $this->render( FALSE, 'Admin' . DS . $this->getAction(), 'Admin' . DS . 'main' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not render the <strong>' . $this->getAction() . '</strong> view in  <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }

    /**
     * editAction - Displays the user view complemented by its data
     * @param
     * @return
    **/
    public function editAction() {
        $this->init( __FUNCTION__ );

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !$this->getModAuth()->getUser()->can( 'edit_users' ) )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( count( NavigationManagement::walks() )<3 )
                NavigationManagement::redirect( DOMAIN . 'users/' );

            $this->setModel();
            $out = $this->getModel()->getUserById( NavigationManagement::walks()[2] );
            if( empty( $out->getEmail() ) )
                NavigationManagement::redirect( DOMAIN . 'users/' );

            $this->getView()->sitename = _( 'Edit user' );
            $this->getView()->user = $out;
            $this->getView()->roles = $this->formatRoles( $this->getModel()->getRole(), $out->getRole( 'keyword' ) );

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

            if( self::isRequiredPassed( array( 'email', 'firstname', 'lastname', 'role' ), $this->getRequest()->post() ) ) :
                $this->setModel();
                if( $this->getModel()->edit( ( count( NavigationManagement::walks() )>2 ? NavigationManagement::walks()[2] : $this->getModAuth()->getUser()->getEmail() ), $this->getRequest()->post() ) ) :
                    if( !empty( $this->getRequest()->post( 'password' ) ) || !empty( $this->getRequest()->post( 'passwordconfirm' ) ) )
                        if( !( $this->getRequest()->post( 'password' )==$this->getRequest()->post( 'passwordconfirm' ) && $this->getModel()->passwordChange( ( count( NavigationManagement::walks() )>2 ? NavigationManagement::walks()[2] : $this->getModAuth()->getUser()->getEmail() ), ClassUser::passwordHash( $this->getRequest()->post( 'passwordconfirm' ) ) ) ) )
                            NavigationManagement::redirect( DOMAIN . 'users/' . ( count( NavigationManagement::walks() )>2 ? 'edit/' . NavigationManagement::walks()[2] : 'profile' ) . '/?_err=password' );

                    if( $this->getRequest()->files( 'avatar' )!==NULL && !empty( $this->getRequest()->files( 'avatar' )['tmp_name'] ) && $this->getRequest()->files( 'avatar' )['size']>0 ) :
                        $user = $this->getModel()->getUserById( ( count( NavigationManagement::walks() )>2 ? NavigationManagement::walks()[2] : $this->getModAuth()->getUser()->getEmail() ) );

                        $upload_dir = UPLOADSPATH . 'avatars' . DS . date( 'Y' ) . DS . date( 'm' ) . DS;
                        if( ( $file = ClassUser::upload( $this->getRequest()->files( 'avatar' ), $upload_dir ) )!==FALSE ) :
                            if( ( $avatar = $this->getModel()->avatarCreate( ( count( NavigationManagement::walks() )>2 ? NavigationManagement::walks()[2] : $this->getModAuth()->getUser()->getEmail() ), $file['filename'], $this->getRequest()->post( 'firstname' ) . ' ' . strtoupper( $this->getRequest()->post( 'lastname' ) ), $this->getRequest()->files( 'avatar' )['type'], $file['currenttimestamp'] ) )===FALSE || !( $this->getModel()->avatarChange( ( count( NavigationManagement::walks() )>2 ? NavigationManagement::walks()[2] : $this->getModAuth()->getUser()->getEmail() ), $avatar ) ) )
                                NavigationManagement::redirect( DOMAIN . 'users/' . ( count( NavigationManagement::walks() )>2 ? 'edit/' . NavigationManagement::walks()[2] : 'profile' ) . '/?_err=avatar' );

                            $datetime = new DateTime( $user->getAvatar( 'upload_date' ) );
                            if( unlink( UPLOADSPATH . 'avatars' . DS . $datetime->format( 'Y' ) . DS . $datetime->format( 'm' ) . DS . $user->getAvatar( 'uri' ) ) )
                                $this->getModel()->avatarDelete( $user->getAvatar( 'id' ) );
                        endif;
                    endif;

                    if( count( NavigationManagement::walks() )<3 || NavigationManagement::walks()[2]==$this->getModAuth()->getUser()->getEmail() ) :
                        $token = $this->getModAuth()->getUser()->getToken();
                        $this->getModAuth()->logout();
                        $this->getModAuth()->login( $this->getModel()->getUserByToken( $token ) );
                    endif;

                    NavigationManagement::redirect( DOMAIN . 'users/' . ( count( NavigationManagement::walks() )>2 ? 'edit/' . NavigationManagement::walks()[2] : 'profile' ) . '/?_err=ok' );
                endif;
            else :
                NavigationManagement::redirect( DOMAIN . 'users/' . ( count( NavigationManagement::walks() )>2 ? 'edit/' . NavigationManagement::walks()[2] : 'profile' ) . '/?_err=required' );
            endif;

            NavigationManagement::redirect( DOMAIN . 'users/' . ( count( NavigationManagement::walks() )>2 ? 'edit/' . NavigationManagement::walks()[2] : 'profile' ) . '/?_err=error' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not applying the <strong>' . $this->getAction() . '</strong> action in <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }

    /**
     * deletingAction - Drops a user
     * @param
     * @return
    **/
    public function deletingAction() {
        $this->init( __FUNCTION__ );

        try {
            if( !$this->isAuthentified() )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !$this->getModAuth()->getUser()->can( 'delete_users' ) )
                NavigationManagement::redirect( DOMAIN . 'error/403/' );

            if( !isset( NavigationManagement::walks()[2] ) )
                NavigationManagement::redirect( DOMAIN . 'users/' );

            $this->setModel();
            $out = $this->getModel()->getUserById( NavigationManagement::walks()[2] );
            if( empty( $out->getEmail() ) )
                NavigationManagement::redirect( DOMAIN . 'users/' );

            if( !$this->getModel()->delete( NavigationManagement::walks()[2] ) )
                NavigationManagement::redirect( DOMAIN . 'users/edit/' . NavigationManagement::walks()[2] . '/?_err=error' );

            if( !empty( $out->getAvatar( 'uri' ) ) ) :
                if( $this->getModel()->avatarDelete( $out->getAvatar( 'id' ) ) )
                    $datetime = new DateTime( $out->getAvatar( 'upload_date' ) );
                    unlink( UPLOADSPATH . 'avatars' . DS . $datetime->format( 'Y' ) . DS . $datetime->format( 'm' ) . DS . $out->getAvatar( 'uri' ) );
                endif;

            NavigationManagement::redirect( DOMAIN . 'users/' );
        } catch( KernelException $e ) {
            throw $e;
        } catch( Exception $e ) {
            throw new KernelException( 'Can not applying the <strong>' . $this->getAction() . '</strong> action in <strong>' . $this->getController() . '</strong>', $e->getCode(), $e );
        }
    }

    /**
     * --------------------------------------------------
     * METHODS
     * --------------------------------------------------
    **/
    /**
     * formatRoles - Formats the roles
     * @param   array       $roles
     *          [string     $selected]
     *          [string     $orderby]
     * @return  string
    **/
    private function formatRoles( $roles, $selected = NULL, $orderby = self::ORDER_BY_POWER ) {
        $tmp = array();

        foreach( $roles as $key=>$role ) :
            if( $roles[$key]['power']>=$this->getModAuth()->getUser()->getRole( 'power' ) ) :
                $roles[$key]['denomination'] = self::translate( $role['denomination'], ( $this->getRequest()->get( 'lang' )!==NULL ? $this->getRequest()->get( 'lang' ) : ISO_LANGUAGE_CODE ) );
                // $tmp[$roles[$key]['denomination']] = $roles[$key];
                $tmp[$roles[$key][$orderby]] = $roles[$key];
            endif;
        endforeach;
        ksort( $tmp );

        $out = '<label class="label required" for="list-role">' . _( 'Role' ) . '</label><select class="field" id="list-role" name="role" required="required">';
        foreach( $tmp as $role )
            $out .= '<option' . ( $selected==$role['keyword'] ? ' selected="selected"' : '' ) . ' value="' . $role['keyword'] . '">' . $role['denomination'] . '</option>';
        $out .= '</select>';

        return $out;
    }
}