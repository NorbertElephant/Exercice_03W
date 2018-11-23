<?php
/**
 * ------------------------------------------------------------
 * CLASS POST
 * (Requires : SplFileInfo | TypeTest)
 * ------------------------------------------------------------
**/
class ClassPost {
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
    /**
     * --------------------------------------------------
     * PROPERTIES
     * --------------------------------------------------
    **/
    private $_id;
    private $_title;
    private $_content;
    private $_excerpt;
    private $_release_date;
    private $_tab;
    private $_type;
    private $_status;
    private $_access;
    private $_format;
    private $_parent;
    private $_author;


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
     * setId -
     * @param   int     $value
     * @return
    **/
    public function setId( $value ) {
        if( TypeTest::is_valid_int( $value ) )
            $this->_id = (int)$value;
    }

    /**
     * setTitle -
     * @param   string  $value
     * @return
    **/
    public function setTitle( $value ) {
        $this->_title = $value;
    }

    /**
     * setContent -
     * @param   string  $value
     * @return
    **/
    public function setContent( $value ) {
        $this->_content = $value;
    }

    /**
     * excerpt -
     * @param   string  $value
     * @return
    **/
    public function setExcerpt( $value ) {
        $this->_excerpt = $value;
    }

    /**
     * setReleaseDate -
     * @param   datetime    $value
     * @return
    **/
    public function setReleaseDate( $value ) {
        if( TypeTest::is_valid_date( $value ) )
            $this->_release_date = $value;
    }

    /**
     * setTab -
     * @param   int     $value
     * @return
    **/
    public function setTab( $value ) {
        if( TypeTest::is_valid_int( $value ) )
            $this->_tab = (int)$value;
    }

    /**
     * setType -
     * @param   string  $value
     * @return
    **/
    public function setType( $value ) {
        $this->_type = $value;
    }

    /**
     * setStatus -
     * @param   string  $value
     * @return
    **/
    public function setStatus( $value ) {
        $this->_status = $value;
    }

    /**
     * setAccess -
     * @param   string  $value
     * @return
    **/
    public function setAccess( $value ) {
        $this->_access = $value;
    }

    /**
     * setFormat -
     * @param   string  $value
     * @return
    **/
    public function setFormat( $value ) {
        $this->_format = $value;
    }

    /**
     * setParent -
     * @param   int     $value
     * @return
    **/
    public function setParent( $value ) {
        if( TypeTest::is_valid_int( $value ) )
            $this->_parent = (int)$value;
    }

    /**
     * setAuthor -
     * @param   string  $value
     * @return
    **/
    public function setAuthor( $value ) {
        if( filter_var( $value, FILTER_VALIDATE_EMAIL ) )
            $this->_author = strtolower( $value );
    }



    /**
     * --------------------------------------------------
     * GETTERS
     * --------------------------------------------------
    **/
    /**
     * getId -
     * @param
     * @return
    **/
    public function getId() {
        return $this->_id;
    }

    /**
     * getTitle -
     * @param
     * @return
    **/
    public function getTitle() {
        return $this->_title;
    }

    /**
     * getContent -
     * @param
     * @return
    **/
    public function getContent() {
        return $this->_content;
    }

    /**
     * getExcerpt -
     * @param
     * @return
    **/
    public function getExcerpt() {
        return $this->_excerpt;
    }

    /**
     * getReleaseDate -
     * @param
     * @return
    **/
    public function getReleaseDate() {
        return $this->_release_date;
    }

    /**
     * getTab -
     * @param
     * @return
    **/
    public function getTab() {
        return $this->_tab;
    }

    /**
     * getType -
     * @param
     * @return
    **/
    public function getType() {
        return $this->_type;
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
     * getAccess -
     * @param
     * @return
    **/
    public function getAccess() {
        return $this->_access;
    }

    /**
     * getFormat -
     * @param
     * @return
    **/
    public function getFormat() {
        return $this->_format;
    }

    /**
     * getParent -
     * @param
     * @return
    **/
    public function getParent() {
        return $this->_parent;
    }

    /**
     * getAuthor -
     * @param
     * @return
    **/
    public function getAuthor() {
        return $this->_author;
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