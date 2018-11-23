<?php
/**
 * ------------------------------------------------------------
 * CLASS USER
 * (Requires : SplFileInfo | TypeTest)
 * ------------------------------------------------------------
**/
class ClassUser {
    use TypeTest;

    /**
     * --------------------------------------------------
     * CONSTANTS
     * --------------------------------------------------
    **/
    // const PREFIX = 'user';
    const DATE_FORMAT = 'Y-m-d';
    const TIME_FORMAT = 'H:i:s';
    const DATETIME_FORMAT = 'Y-m-d H:i:s';

    const PARAM_CRYPT = PASSWORD_BCRYPT;
    /**
     * --------------------------------------------------
     * PROPERTIES
     * --------------------------------------------------
    **/
    private $_email;
    private $_login;
    private $_password;
    private $_lastname;
    private $_firstname;
    private $_registration_date;
    private $_last_connection_date;
    private $_status;
    private $_avatar;
    private $_media;
    private $_token;
    private $_role;
    private $_capabilities;


    /**
     * --------------------------------------------------
     * MAGIC METHODS
     * --------------------------------------------------
    **/
    /**
     * __construct - Class constructor
     * @param   array   $settings   [optional]
     * @return
    **/
    public function __construct( $settings = array() ) {
        $this->hydrate( $settings );
    }



    /**
     * --------------------------------------------------
     * SETTERS
     * --------------------------------------------------
    **/
    /**
     * setEmail -
     * @param   string  $value
     * @return
    **/
    public function setEmail( $value ) {
        if( filter_var( $value, FILTER_VALIDATE_EMAIL ) )
            $this->_email = strtolower( $value );
    }

    /**
     * setLogin -
     * @param   string  $value
     * @return
    **/
    public function setLogin( $value ) {
        $this->_login = $value;
    }

    /**
     * setPassword -
     * @param   string  $value
     * @return
    **/
    protected function setPassword( $value ) {
        $this->_password = $value;
    }

    /**
     * setLastname -
     * @param   string  $value
     * @return
    **/
    public function setLastname( $value ) {
        $this->_lastname = strtoupper( $value );
    }

    /**
     * setFirstname -
     * @param   string  $value
     * @return
    **/
    public function setFirstname( $value ) {
        $this->_firstname = ucwords( $value );
    }

    /**
     * setRegistrationDate -
     * @param   datetime    $value
     * @return
    **/
    protected function setRegistrationDate( $value ) {
        if( TypeTest::is_valid_date( $value ) )
            $this->_registration_date = $value;
    }

    /**
     * setLastConnectionDate -
     * @param   datetime    $value
     * @return
    **/
    protected function setLastConnectionDate( $value ) {
        if( TypeTest::is_valid_date( $value ) )
            $this->_last_connection_date = $value;
    }

    /**
     * setStatus -
     * @param   bool    $value
     * @return
    **/
    protected function setStatus( $value ) {
        if( TypeTest::is_valid_bool( $value ) )
            $this->_status = $value;
    }

    /**
     * setAvatar -
     * @param   string  $value
     * @return
    **/
    public function setAvatar( $value ) {
        $this->_avatar = $value;
    }

    /**
     * setMedia -
     * @param   string  $value
     * @return
    **/
    public function setMedia( $value ) {
        $this->_media = $value;
    }

    /**
     * setToken -
     * @param   string  $value
     * @return
    **/
    protected function setToken( $value ) {
        $this->_token = $value;
    }

    /**
     * setRole -
     * @param   string  $value
     * @return
    **/
    protected function setRole( $value ) {
        $this->_role = $value;
    }

    /**
     * setCapabilities -
     * @param   array   $value
     * @return
    **/
    protected function setCapabilities( $value ) {
        $this->_capabilities = $value;
    }



    /**
     * --------------------------------------------------
     * GETTERS
     * --------------------------------------------------
    **/
    /**
     * getEmail -
     * @param
     * @return
    **/
    public function getEmail() {
        return $this->_email;
    }

    /**
     * getLogin -
     * @param
     * @return
    **/
    public function getLogin() {
        return $this->_login;
    }

    /**
     * getPassword -
     * @param
     * @return
    **/
    protected function getPassword() {
        return $this->_password;
    }

    /**
     * getLastname -
     * @param
     * @return
    **/
    public function getLastname() {
        return $this->_lastname;
    }

    /**
     * getFirstname -
     * @param
     * @return
    **/
    public function getFirstname() {
        return $this->_firstname;
    }

    /**
     * getRegistrationDate -
     * @param
     * @return
    **/
    public function getRegistrationDate() {
        return $this->_registration_date;
    }

    /**
     * getLastConnectionDate -
     * @param
     * @return
    **/
    public function getLastConnectionDate() {
        return $this->_last_connection_date;
    }

    /**
     * getStatus -
     * @param
     * @return
    **/
    public function getStatus() {
        return $this->_status;
    }

    /**
     * getAvatar -
     * @param   [string     $attribute]
     * @return
    **/
    public function getAvatar( $attribute = NULL ) {
        if( !empty( $attribute ) )
            return json_decode( $this->_avatar )->$attribute;

        return $this->_role;
    }

    /**
     * getMedia -
     * @param
     * @return
    **/
    public function getMedia() {
        return $this->_media;
    }

    /**
     * getToken -
     * @param
     * @return
    **/
    public function getToken() {
        return $this->_token;
    }

    /**
     * getRole -
     * @param   [string     $attribute]
     * @return
    **/
    public function getRole( $attribute = NULL ) {
        if( !empty( $attribute ) )
            return json_decode( $this->_role )->$attribute;

        return $this->_role;
    }

    /**
     * getCapabilities -
     * @param
     * @return
    **/
    public function getCapabilities() {
        return $this->_capabilities;
    }



    /**
     * --------------------------------------------------
     * STATIC METHODS
     * --------------------------------------------------
    **/
    /**
     * betterCost - Determines the better cost for hashing passwords
     * @param   int     $crypt      [optional]
     *          float   $timeTarget [optional]
     * @return
    **/
    public static function betterCost( $crypt = self::PARAM_CRYPT, $timeTarget = 0.05 ) {
        $cost = 8;

        do {
            $cost++;
            $start = microtime( TRUE );
            password_hash( 'test', $crypt, array( 'cost' => $cost ) );
            $end = microtime( TRUE );
        } while( ( $end - $start )<=$timeTarget );

        return $cost;
    }

    /**
     * passwordHash - Generates a hashed password
     * @param   string  $password
     *          array   $hashOptions    [optional]
     * @return
    **/
    public static function passwordHash( $password, $hashOptions = array( 'cost'=>8, 'crypt'=>self::PARAM_CRYPT ) ) {
        $options = array(
            'cost'  => $hashOptions['cost']
            // 'salt'  => mcrypt_create_iv( 22, MCRYPT_DEV_URANDOM )
        );

        return password_hash( $password, $hashOptions['crypt'], $options );
    }

    /**
     * passwordHash - Checkes a hashed password
     * @param   string  $entered
     *          string  $stored
     * @return
    **/
    public static function passwordVerify( $entered, $stored ) {
        return password_verify( $entered, $stored );
    }



    /**
     * --------------------------------------------------
     * METHODS
     * --------------------------------------------------
    **/
    /**
     * upload - Uploads file
     * @param   string  $file
     *          string  $path
     * @return  mixed (array|bool)
    **/
    static public function upload( $file, $path ) {
        if( !file_exists( $path ) || !is_dir( $path ) )
            mkdir( $path, 0777, TRUE );

        $spl = new SplFileInfo( $file['name'] );
        $extension = $spl->getExtension();
        $currenttimestamp = date( 'Y-m-d H:i:s' );
        $filename = $spl->getBasename( '.' . $extension ) . '_' . preg_replace( '/((?!\d).)*/', '', $currenttimestamp ) . '.' . $extension;

        if( move_uploaded_file( $file['tmp_name'], $path . $filename ) )
            return array(
                'filename'          => $filename,
                'currenttimestamp'  => $currenttimestamp
            );

        return FALSE;
    }

    /**
     * can - Checks the capability
     * @param   string      $capability
     * @return
    **/
    public function can( $capability ) {
        return ( $this->getRole( 'power' )===0 || in_array( $capability, explode( ',', $this->getCapabilities() ) ) );
    }

    /**
     * avatar - Displays avatar
     * @param   string  $show
     * @return
    **/
    public function avatar( $show = NULL ) {
        if( !empty( $this->getAvatar( 'uri' ) ) ) :
            $datetime = new DateTime( $this->getAvatar( 'upload_date' ) );
            $out = '<img alt="" class="avatar x90" src="' . THEME_URL . 'uploads/avatars/' . $datetime->format( 'Y' ) . '/' . $datetime->format( 'm' ) . '/' . $this->getAvatar( 'uri' ) . '">';
        else :
            $out = '<i class="fa fa-user-circle fa-2x avatar x90" aria-hidden="true"></i>';
        endif;

        if( $show!=='display' )
            return $out;
        else
            echo $out;
    }

    /**
     * hydrate - Sets automatically each properties depending on datas
     * @param   array   $datas
     * @return
    **/
    private function hydrate( $datas ) {
        foreach( $datas as $key=>$value ) :
            // $key = preg_replace( '/^' . self::PREFIX . '_(.+)$/', '$1', $key );
            $key = str_replace( '_', ' ', $key );
            $key = ucwords( $key );
            $key = str_replace( ' ', '', $key );
            $method = 'set' . $key;

            if( method_exists( $this, $method) )
                $this->$method( $value );
        endforeach;
    }
}