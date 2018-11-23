<?php
/**
 * ------------------------------------------------------------
 * USERS MODEL
 * (Requires : KernelException | KernelModel | ClassUser)
 * ------------------------------------------------------------
**/
class UsersModel extends KernelModel {
    /**
     * --------------------------------------------------
     * CONSTANTS
     * --------------------------------------------------
    **/
    const ALL = '-1';

    /**
     * --------------------------------------------------
     * METHODS
     * --------------------------------------------------
    **/
    /**
     * userExists - Performs a database select query
     * @param   string  $id
     * @return  bool
    **/
    public function userExists( $id ) {
        try {
            if( ( $datas = $this->query( 'SELECT `user`.`email` FROM `user` WHERE `user`.`email`=:id', array( 'id' => array( 'VAL' => $id ) ) ) )!==FALSE )
                return TRUE;

            return FALSE;
        } catch( PDOException $e ) {
            throw new KernelException( 'Can not get the <strong>' . $this->getModel() . '</strong> datas', $e->getCode(), $e );
        }
    }

    /**
     * getUserByToken - Performs a database select query
     * @param   [string     $token]
     * @return  mixed (ClassUser|array|bool)
    **/
    public function getUserByToken( $token = NULL ) {
        try {
            if( !empty( $token ) )
                if( ( $datas = $this->query( 'SELECT `user`.`email`, `user`.`login`, `user`.`firstname`, `user`.`lastname`, `user`.`registration_date`, `user`.`last_connection_date`, `user`.`status`, CONCAT( "{", "\"id\":", `media`.`id`, ",", "\"uri\"", ":", "\"", `media`.`uri`, "\"", ",", "\"title\"", ":", "\"", `media`.`title`, "\"", ",", "\"description\"", ":", "\"", `media`.`description`, "\"", ",", "\"mime\"", ":", "\"", `media`.`mime`, "\"", ",", "\"upload_date\"", ":", "\"", `media`.`upload_date`, "\"", "}" ) AS avatar, `user`.`token`, CONCAT( "{", "\"keyword\"", ":", "\"", `role`.`keyword`, "\"", ",", "\"denomination\"", ":", "\"", `role`.`denomination`, "\"", ",", "\"power\":", `role`.`power`, "}" ) AS role, GROUP_CONCAT( `capability`.`keyword` SEPARATOR "," ) AS capabilities FROM `user` LEFT JOIN `media` ON `user`.`avatar`=`media`.`id` JOIN `role` ON `user`.`role`=`role`.`keyword` LEFT JOIN `allowed_to` ON `role`.`keyword`=`allowed_to`.`role` LEFT JOIN `capability` ON `allowed_to`.`capability`=`capability`.`keyword` WHERE `user`.`token`=:token GROUP BY `user`.`email` ORDER BY `user`.`firstname` ASC, `user`.`lastname` ASC, `user`.`login` ASC, `user`.`email` ASC', array( 'token' => array( 'VAL' => $token ) ) ) )!==FALSE ) :
                    return new ClassUser( $datas );
                endif;
            else
                if( ( $datas = $this->query( 'SELECT `user`.`email`, `user`.`login`, `user`.`firstname`, `user`.`lastname`, `user`.`registration_date`, `user`.`last_connection_date`, `user`.`status`, CONCAT( "{", "\"id\":", `media`.`id`, ",", "\"uri\"", ":", "\"", `media`.`uri`, "\"", ",", "\"title\"", ":", "\"", `media`.`title`, "\"", ",", "\"description\"", ":", "\"", `media`.`description`, "\"", ",", "\"mime\"", ":", "\"", `media`.`mime`, "\"", ",", "\"upload_date\"", ":", "\"", `media`.`upload_date`, "\"", "}" ) AS avatar, `user`.`token`, CONCAT( "{", "\"keyword\"", ":", "\"", `role`.`keyword`, "\"", ",", "\"denomination\"", ":", "\"", `role`.`denomination`, "\"", ",", "\"power\":", `role`.`power`, "}" ) AS role, GROUP_CONCAT( `capability`.`keyword` SEPARATOR "," ) AS capabilities FROM `user` LEFT JOIN `media` ON `user`.`avatar`=`media`.`id` JOIN `role` ON `user`.`role`=`role`.`keyword` LEFT JOIN `allowed_to` ON `role`.`keyword`=`allowed_to`.`role` LEFT JOIN `capability` ON `allowed_to`.`capability`=`capability`.`keyword` GROUP BY `user`.`email` ORDER BY `user`.`firstname` ASC, `user`.`lastname` ASC, `user`.`login` ASC, `user`.`email` ASC', array(), array( self::ATTR_RETURNMODE=>self::RETURNMODE_FETCHALL ) ) )!==FALSE ) :
                    foreach( $datas as $item ) :
                        $out[] = new ClassUser( $item );
                    endforeach;

                    return ( isset( $out ) ? $out : array() );
                endif;

            return FALSE;
        } catch( PDOException $e ) {
            throw new KernelException( 'Can not get the <strong>' . $this->getModel() . '</strong> datas', $e->getCode(), $e );
        }
    }

    /**
     * getUserById - Performs a database select query
     * @param   [string     $id]
     * @return  mixed (ClassUser|array|bool)
    **/
    public function getUserById( $id = NULL ) {
        try {
            if( !empty( $id ) )
                if( ( $datas = $this->query( 'SELECT `user`.`email`, `user`.`login`, `user`.`firstname`, `user`.`lastname`, `user`.`registration_date`, `user`.`last_connection_date`, `user`.`status`, CONCAT( "{", "\"id\":", `media`.`id`, ",", "\"uri\"", ":", "\"", `media`.`uri`, "\"", ",", "\"title\"", ":", "\"", `media`.`title`, "\"", ",", "\"description\"", ":", "\"", `media`.`description`, "\"", ",", "\"mime\"", ":", "\"", `media`.`mime`, "\"", ",", "\"upload_date\"", ":", "\"", `media`.`upload_date`, "\"", "}" ) AS avatar, `user`.`token`, CONCAT( "{", "\"keyword\"", ":", "\"", `role`.`keyword`, "\"", ",", "\"denomination\"", ":", "\"", `role`.`denomination`, "\"", ",", "\"power\":", `role`.`power`, "}" ) AS role, GROUP_CONCAT( `capability`.`keyword` SEPARATOR "," ) AS capabilities FROM `user` LEFT JOIN `media` ON `user`.`avatar`=`media`.`id` JOIN `role` ON `user`.`role`=`role`.`keyword` LEFT JOIN `allowed_to` ON `role`.`keyword`=`allowed_to`.`role` LEFT JOIN `capability` ON `allowed_to`.`capability`=`capability`.`keyword` WHERE `user`.`email`=:id GROUP BY `user`.`email` ORDER BY `user`.`firstname` ASC, `user`.`lastname` ASC, `user`.`login` ASC, `user`.`email` ASC', array( 'id' => array( 'VAL' => $id ) ) ) )!==FALSE ) :
                    return new ClassUser( $datas );
                endif;
            else
                if( ( $datas = $this->query( 'SELECT `user`.`email`, `user`.`login`, `user`.`firstname`, `user`.`lastname`, `user`.`registration_date`, `user`.`last_connection_date`, `user`.`status`, CONCAT( "{", "\"id\":", `media`.`id`, ",", "\"uri\"", ":", "\"", `media`.`uri`, "\"", ",", "\"title\"", ":", "\"", `media`.`title`, "\"", ",", "\"description\"", ":", "\"", `media`.`description`, "\"", ",", "\"mime\"", ":", "\"", `media`.`mime`, "\"", ",", "\"upload_date\"", ":", "\"", `media`.`upload_date`, "\"", "}" ) AS avatar, `user`.`token`, CONCAT( "{", "\"keyword\"", ":", "\"", `role`.`keyword`, "\"", ",", "\"denomination\"", ":", "\"", `role`.`denomination`, "\"", ",", "\"power\":", `role`.`power`, "}" ) AS role, GROUP_CONCAT( `capability`.`keyword` SEPARATOR "," ) AS capabilities FROM `user` LEFT JOIN `media` ON `user`.`avatar`=`media`.`id` JOIN `role` ON `user`.`role`=`role`.`keyword` LEFT JOIN `allowed_to` ON `role`.`keyword`=`allowed_to`.`role` LEFT JOIN `capability` ON `allowed_to`.`capability`=`capability`.`keyword` GROUP BY `user`.`email` ORDER BY `user`.`firstname` ASC, `user`.`lastname` ASC, `user`.`login` ASC, `user`.`email` ASC', array(), array( self::ATTR_RETURNMODE=>self::RETURNMODE_FETCHALL ) ) )!==FALSE ) :
                    foreach( $datas as $item ) :
                        $out[] = new ClassUser( $item );
                    endforeach;

                    return ( isset( $out ) ? $out : array() );
                endif;

            return FALSE;
        } catch( PDOException $e ) {
            throw new KernelException( 'Can not get the <strong>' . $this->getModel() . '</strong> datas', $e->getCode(), $e );
        }
    }

    /**
     * getUserByRole - Performs a database select query
     * @param   [string     $role]
     * @return  mixed (ClassUser|array|bool)
    **/
    public function getUserByRole( $role = NULL ) {
        try {
            if( !empty( $role ) )
                $datas = $this->query( 'SELECT `user`.`email`, `user`.`login`, `user`.`firstname`, `user`.`lastname`, `user`.`registration_date`, `user`.`last_connection_date`, `user`.`status`, CONCAT( "{", "\"id\":", `media`.`id`, ",", "\"uri\"", ":", "\"", `media`.`uri`, "\"", ",", "\"title\"", ":", "\"", `media`.`title`, "\"", ",", "\"description\"", ":", "\"", `media`.`description`, "\"", ",", "\"mime\"", ":", "\"", `media`.`mime`, "\"", ",", "\"upload_date\"", ":", "\"", `media`.`upload_date`, "\"", "}" ) AS avatar, `user`.`token`, CONCAT( "{", "\"keyword\"", ":", "\"", `role`.`keyword`, "\"", ",", "\"denomination\"", ":", "\"", `role`.`denomination`, "\"", ",", "\"power\":", `role`.`power`, "}" ) AS role, GROUP_CONCAT( `capability`.`keyword` SEPARATOR "," ) AS capabilities FROM `user` LEFT JOIN `media` ON `user`.`avatar`=`media`.`id` JOIN `role` ON `user`.`role`=`role`.`keyword` LEFT JOIN `allowed_to` ON `role`.`keyword`=`allowed_to`.`role` LEFT JOIN `capability` ON `allowed_to`.`capability`=`capability`.`keyword` WHERE `user`.`role`=:role GROUP BY `user`.`email` ORDER BY `user`.`firstname` ASC, `user`.`lastname` ASC, `user`.`login` ASC, `user`.`email` ASC', array( 'role' => array( 'VAL' => $role ) ), array( self::ATTR_RETURNMODE=>self::RETURNMODE_FETCHALL ) );
            else
                $datas = $this->query( 'SELECT `user`.`email`, `user`.`login`, `user`.`firstname`, `user`.`lastname`, `user`.`registration_date`, `user`.`last_connection_date`, `user`.`status`, CONCAT( "{", "\"id\":", `media`.`id`, ",", "\"uri\"", ":", "\"", `media`.`uri`, "\"", ",", "\"title\"", ":", "\"", `media`.`title`, "\"", ",", "\"description\"", ":", "\"", `media`.`description`, "\"", ",", "\"mime\"", ":", "\"", `media`.`mime`, "\"", ",", "\"upload_date\"", ":", "\"", `media`.`upload_date`, "\"", "}" ) AS avatar, `user`.`token`, CONCAT( "{", "\"keyword\"", ":", "\"", `role`.`keyword`, "\"", ",", "\"denomination\"", ":", "\"", `role`.`denomination`, "\"", ",", "\"power\":", `role`.`power`, "}" ) AS role, GROUP_CONCAT( `capability`.`keyword` SEPARATOR "," ) AS capabilities FROM `user` LEFT JOIN `media` ON `user`.`avatar`=`media`.`id` JOIN `role` ON `user`.`role`=`role`.`keyword` LEFT JOIN `allowed_to` ON `role`.`keyword`=`allowed_to`.`role` LEFT JOIN `capability` ON `allowed_to`.`capability`=`capability`.`keyword` GROUP BY `user`.`email` ORDER BY `user`.`firstname` ASC, `user`.`lastname` ASC, `user`.`login` ASC, `user`.`email` ASC', array(), array( self::ATTR_RETURNMODE=>self::RETURNMODE_FETCHALL ) );

            if( $datas!==FALSE ) :
                foreach( $datas as $item ) :
                    $out[] = new ClassUser( $item );
                endforeach;

                return ( isset( $out ) ? $out : array() );
            endif;

            return FALSE;
        } catch( PDOException $e ) {
            throw new KernelException( 'Can not get the <strong>' . $this->getModel() . '</strong> datas', $e->getCode(), $e );
        }
    }

    /**
     * getRoleByToken - Performs a database select query
     * @param   string  $token
     * @return  mixed (array|bool)
    **/
    public function getRoleByToken( $token ) {
        try {
            return $this->query( 'SELECT `role`.`keyword`, `role`.`denomination`, `role`.`power` FROM `role` JOIN `user` ON `role`.`keyword`=`user`.`role` WHERE `user`.`token`=:token', array( 'token' => array( 'VAL' => $token ) ) );
        } catch( PDOException $e ) {
            throw new KernelException( 'Can not get the <strong>' . $this->getModel() . '</strong> datas', $e->getCode(), $e );
        }
    }

    /**
     * getAvatar - Performs a database select query
     * @param   int     $id
     * @return  mixed (array|bool)
    **/
    public function getAvatar( $id ) {
        try {
            return $this->query( 'SELECT `id`, `uri`, `title`, `description`, `mime`, `upload_date` FROM `media` WHERE `id`=:id', array( 'id' => array( 'VAL' => $id, 'TYPE' => PDO::PARAM_INT ) ) );
        } catch( PDOException $e ) {
            throw new KernelException( 'Can not get the <strong>' . $this->getModel() . '</strong> datas', $e->getCode(), $e );
        }
    }

    /**
     * getAvatarByEmail - Performs a database select query
     * @param   string  $email
     * @return  mixed (array|bool)
    **/
    public function getAvatarByEmail( $email ) {
        try {
            return $this->query( 'SELECT `media`.`id`, `media`.`uri`, `media`.`title`, `media`.`description`, `media`.`mime`, `media`.`upload_date` FROM `media` JOIN `user` ON `media`.`id`=`user`.`avatar` WHERE `user`.`email`=:email', array( 'email' => array( 'VAL' => $email ) ) );
        } catch( PDOException $e ) {
            throw new KernelException( 'Can not get the <strong>' . $this->getModel() . '</strong> datas', $e->getCode(), $e );
        }
    }

    /**
     * getRole - Performs a database select query
     * @param   [string     $role]
     * @return  mixed (array|bool)
    **/
    public function getRole( $role = NULL ) {
        try {
            if( !empty( $role ) )
                return $this->query( 'SELECT `keyword`, `denomination`, `power` FROM `role` WHERE `keyword`=:role', array( 'role' => array( 'VAL' => $role ) ) );
            else
                return $this->query( 'SELECT `keyword`, `denomination`, `power` FROM `role` ORDER BY `denomination` ASC', array(), array( self::ATTR_RETURNMODE=>self::RETURNMODE_FETCHALL ) );

        } catch( PDOException $e ) {
            throw new KernelException( 'Can not get the <strong>' . $this->getModel() . '</strong> datas', $e->getCode(), $e );
        }
    }

    /**
     * isAuthMatch - Performs a database select query
     * @param   array   $post
     * @return  mixed (string|bool)
    **/
    public function isAuthMatch( Array $post ) {
        try {
            foreach( $this->query( 'SELECT `email`, `login`, `password` FROM `user` WHERE ( `login`=:login OR `email`=:login ) AND `status`=1', array( 'login' => array( 'VAL' => $post['login'] ) ), array( self::ATTR_RETURNMODE => self::RETURNMODE_FETCHALL ) ) as $matching ) :
                if( ClassUser::passwordVerify( $post['password'], $matching['password'] ) )
                    return $this->setToken( ClassUser::passwordHash( uniqid() ), $matching['email'] );
            endforeach;

            return FALSE;
        } catch( PDOException $e ) {
            throw new KernelException( 'Can not get the <strong>' . $this->getModel() . '</strong> datas', $e->getCode(), $e );
        }
    }

    /**
     * setToken - Performs a database update query
     * @param   string      $token
     *          [string     $email]
     * @return  mixed (string|bool)
    **/
    public function setToken( $token, $email = NULL ) {
        try {
            if( ( isset( $email ) && $this->query( 'UPDATE `user` SET `token`=:token, `last_connection_date`=NOW() WHERE `email`=:email', array( 'token' => array( 'VAL' => $token ), 'email' => array( 'VAL' => $email ) ) ) ) || $this->query( 'UPDATE `user` SET `token`="" WHERE `token`=:token', array( 'token' => array( 'VAL' => $token ) ) ) )
                return $token;

            return FALSE;
        } catch( PDOException $e ) {
            throw new KernelException( 'Can not get the <strong>' . $this->getModel() . '</strong> datas', $e->getCode(), $e );
        }
    }

    /**
     * add - Performs a database insert query
     * @param   array   $post
     *          [int    $avatar]
     * @return  bool
    **/
    public function add( $post, $avatar = NULL ) {
        try {
            $user = new ClassUser( $post );
            $values = array();
            foreach( $post as $key => $value ) :
                switch( $key ) :
                    case 'avatar':
                        break;
                    case 'password':
                        $values[$key] = array( 'VAL' => ClassUser::passwordHash( $value ) );
                        break;
                    default:
                        $method = 'get' . ucwords( $key );
                        if( method_exists( $user, $method ) && $user->$method()!==NULL )
                            $values[$key] = array( 'VAL' => $user->$method() );
                endswitch;
            endforeach;

            if( !empty( $avatar ) )
                $values['avatar'] = array( 'VAL' => $avatar, 'TYPE' => PDO::PARAM_INT );

            return $this->query( 'INSERT INTO `user` ( `email`, `login`, `password`, `lastname`, `firstname`, `registration_date`, `status`' . ( !empty( $avatar ) ? ', `avatar`' : '' ) . ', `role` ) VALUES ( :email, :login, :password, :lastname, :firstname, NOW(), 1' . ( !empty( $avatar ) ? ', :avatar' : '' ) . ', :role )', $values );
        } catch( PDOException $e ) {
            throw new KernelException( 'Can not get the <strong>' . $this->getModel() . '</strong> datas', $e->getCode(), $e );
        }
    }

    /**
     * avatarCreate - Performs a database insert query
     * @param   string      $email
     *          string      $avatar
     *          string      $title
     *          string      $mime
     *          datetime    $currenttimestamp
     * @return  mixed (int|bool)
    **/
    public function avatarCreate( $email, $avatar, $title, $mime, $currenttimestamp ) {
        try {
            return $this->query( 'INSERT INTO `media` ( `uri`, `title`, `description`, `mime`, `upload_date` ) VALUES ( :uri, :title, :description, :mime, :upload_date )', array( 'uri' => array( 'VAL' => $avatar ), 'title' => array( 'VAL' => $title ), 'description' => array( 'VAL' => 'Avatar' ), 'mime' => array( 'VAL' => $mime ), 'upload_date' => array( 'VAL' => $currenttimestamp ) ), array( self::ATTR_RETURNMODE => self::RETURNMODE_LASTINSERTID ) );
        } catch( PDOException $e ) {
            throw new KernelException( 'Can not get the <strong>' . $this->getModel() . '</strong> datas', $e->getCode(), $e );
        }
    }

    /**
     * edit - Performs a database update query
     * @param   string  $email
     *          array   $post
     * @return  bool
    **/
    public function edit( $email, $post ) {
        try {
            $user = new ClassUser( $post );
            $values = array( 'selector' => array( 'VAL' => $email ) );
            foreach( $post as $key => $value ) :
                switch( $key ) :
                    case 'password':
                    case 'avatar':
                        break;
                    default:
                        $method = 'get' . ucwords( $key );
                        if( method_exists( $user, $method ) && $user->$method()!==NULL )
                            $values[$key] = array( 'VAL' => $user->$method() );
                endswitch;
            endforeach;

            return $this->query( 'UPDATE `user` SET `email`=:email, `login`=:login, `lastname`=:lastname, `firstname`=:firstname, `role`=:role WHERE `email`=:selector', $values );
        } catch( PDOException $e ) {
            throw new KernelException( 'Can not get the <strong>' . $this->getModel() . '</strong> datas', $e->getCode(), $e );
        }
    }

    /**
     * passwordChange - Performs a database update query
     * @param   string  $email
     *          string  $password
     * @return  bool
    **/
    public function passwordChange( $email, $password ) {
        try {
            return $this->query( 'UPDATE `user` SET `password`=:password WHERE `email`=:email', array( 'email' => array( 'VAL' => $email ), 'password' => array( 'VAL' => $password ) ) );
        } catch( PDOException $e ) {
            throw new KernelException( 'Can not get the <strong>' . $this->getModel() . '</strong> datas', $e->getCode(), $e );
        }
    }

    /**
     * avatarChange - Performs a database update query
     * @param   string      $email
     *          int         $avatar
     * @return  bool
    **/
    public function avatarChange( $email, $avatar ) {
        try {
            return $this->query( 'UPDATE `user` SET `avatar`=:avatar WHERE `email`=:email', array( 'email' => array( 'VAL' => $email ), 'avatar' => array( 'VAL' => $avatar, 'TYPE' => PDO::PARAM_INT ) ) );
        } catch( PDOException $e ) {
            throw new KernelException( 'Can not get the <strong>' . $this->getModel() . '</strong> datas', $e->getCode(), $e );
        }
    }

    /**
     * delete - Performs a database delete query
     * @param   string  $id
     * @return  bool
    **/
    public function delete( $id ) {
        try {
            return $this->query( 'DELETE FROM `user` WHERE `email`=:id', array( 'id' => array( 'VAL' => $id ) ) );
        } catch( PDOException $e ) {
            throw new KernelException( 'Can not get the <strong>' . $this->getModel() . '</strong> datas', $e->getCode(), $e );
        }
    }

    /**
     * avatarDelete - Performs a database delete query
     * @param   int     $id
     * @return  bool
    **/
    public function avatarDelete( $id ) {
        try {
            return $this->query( 'DELETE FROM `media` WHERE `id`=:id', array( 'id' => array( 'VAL' => (int)$id, 'TYPE' => PDO::PARAM_INT ) ) );
        } catch( PDOException $e ) {
            throw new KernelException( 'Can not get the <strong>' . $this->getModel() . '</strong> datas', $e->getCode(), $e );
        }
    }
}