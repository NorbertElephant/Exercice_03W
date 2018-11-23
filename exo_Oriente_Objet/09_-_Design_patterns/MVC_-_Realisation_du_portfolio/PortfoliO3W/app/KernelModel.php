<?php
// METTRE AU PROPRE : Params / Setters / Getters / Returns / Visibilité
/**
 * ------------------------------------------------------------
 * KERNEL MODEL
 * (Requires : TypeTest | SPDO)
 * ------------------------------------------------------------
**/
class KernelModel {
    use TypeTest;

    /**
     * --------------------------------------------------
     * CONSTANTS
     * --------------------------------------------------
    **/
    const ATTR_RETURNMODE = 'returningOption';
    const RETURNMODE_LASTINSERTID = 'lastInstertId';
    const RETURNMODE_ROWCOUNT = 'rowCount';
    const RETURNMODE_FETCHALL = 'fetchAll';
    /**
     * --------------------------------------------------
     * PROPERTIES
     * --------------------------------------------------
    **/
    private $_model;
    private $_db;



    /**
     * --------------------------------------------------
     * MAGIC METHODS
     * --------------------------------------------------
    **/
    /**
     * __construct - Class constructor
     * @param
     * @return
    **/
    public function __construct() {
        $this->_model = substr( get_class( $this ), 0, strlen( 'Model' )*(-1) );
        $this->_db = SPDO::getInstance( DB_HOST, DB_NAME, DB_LOGIN, DB_PWD )->getPDO(); // Defines PDO instance
    }



    /**
     * --------------------------------------------------
     * SETTERS
     * --------------------------------------------------
    **/
    /**
     * getModel -
     * @param
     * @return  String
    **/
    protected function getModel() {
        return $this->_model;
    }

    /**
     * getDB -
     * @param
     * @return  PDO
    **/
    protected function getDB() {
        return $this->_db;
    }



    /**
     * --------------------------------------------------
     * METHODS
     * --------------------------------------------------
    **/
    /**
     * getSetting -
     * @param   [string     $setting]
     * @return  string
    **/
    public function getSetting( $setting = NULL ) {
        if( ( $out = $this->query( 'SELECT `value` FROM `setting` WHERE `denomination` = :setting', array( 'setting' => array( 'VAL' => $setting, 'TYPE' => PDO::PARAM_STR ) ) ) )!==FALSE )
            return $out['value'];

        return FALSE;
    }

    /**
     * increaseGroupConcatMaxLen - Performs a query on database for the session
     * @param   [int    $number]
     * @return  bool
    **/
    protected function increaseGroupConcatMaxLen( Int $number = 1024 ) {
        return $this->query( 'SET SESSION group_concat_max_len = :increase', array( 'increase' => array( 'VAL' => $number, 'TYPE' => PDO::PARAM_INT ) ) ); // CAUTION: GROUP_CONCAT() truncates the number of results based on the value of a MySQL constant (group_concat_max_len, which is set to 1024 bits by default). This value should be increased (globally with GLOBAL or only for the session with SESSION) thanks to this query
    }

    /**
     * query - Performs a database query
     * @param   string  $str
     *          [array  $values]
     *          [array  $options]
     * @return  mixed (array|bool)
    **/
    protected function query( $str, Array $values = array(), Array $options = array() ) {
        try {
            if( count( $values )>0 )
                if( ( $stmt = $this->_db->prepare( $str ) )!==FALSE ) :
                    $ctrl = TRUE;
                    foreach( $values as $key => $value ) :
                        if( ( $ctrl = $stmt->bindValue( $key, $value['VAL'], ( isset( $value['TYPE'] ) ? $value['TYPE'] : PDO::PARAM_STR ) ) )===FALSE )
                            break;

                    endforeach;

                    if( $ctrl && ( $out = $stmt->execute() ) ) :
                        switch( strtoupper( substr( $str, 0, 6 ) ) ) :
                            case 'SELECT':
                                $result_set = $stmt->fetchAll( PDO::FETCH_ASSOC );
                                $stmt->closeCursor();

                                return ( count( $result_set )>1 || ( isset( $options[self::ATTR_RETURNMODE] ) && $options[self::ATTR_RETURNMODE]==self::RETURNMODE_FETCHALL ) ? $result_set : ( count( $result_set )>0 ? $result_set[0] : array() ) );
                                break;
                            case 'INSERT':
                                $stmt->closeCursor();
                                return ( isset( $options[self::ATTR_RETURNMODE] ) && $options[self::ATTR_RETURNMODE]==self::RETURNMODE_LASTINSERTID ? $this->_db->lastInsertId() : $out );
                                break;
                            default:
                                $result_set = $stmt->rowCount();
                                $stmt->closeCursor();
                                return ( isset( $options[self::ATTR_RETURNMODE] ) && $options[self::ATTR_RETURNMODE]==self::RETURNMODE_ROWCOUNT ? $result_set : $out );
                        endswitch;
                    endif;
                endif;
            else
                switch( strtoupper( substr( $str, 0, 6 ) ) ) :
                    case 'SELECT':
                        if( ( $stmt = $this->_db->query( $str ) )!==FALSE ) :
                            $result_set = $stmt->fetchAll( PDO::FETCH_ASSOC );
                            $stmt->closeCursor();

                            return ( count( $result_set )>1 || ( isset( $options[self::ATTR_RETURNMODE] ) && $options[self::ATTR_RETURNMODE]==self::RETURNMODE_FETCHALL ) ? $result_set : ( count( $result_set )>0 ? $result_set[0] : array() ) );
                        endif;
                        break;
                    case 'INSERT':
                        if( ( $stmt = $this->_db->query( $str ) )!==FALSE ) :
                            $stmt->closeCursor();
                            return ( isset( $options[self::ATTR_RETURNMODE] ) && $options[self::ATTR_RETURNMODE]==self::RETURNMODE_LASTINSERTID ? $this->_db->lastInsertId() : TRUE );
                        endif;
                        break;
                    default:
                        if( ( $stmt = $this->_db->exec( $str ) )!==FALSE )
                            return ( isset( $options[self::ATTR_RETURNMODE] ) && $options[self::ATTR_RETURNMODE]==self::RETURNMODE_ROWCOUNT ? $stmt : TRUE );
                endswitch;

            return FALSE;
        } catch( PDOException $e ) {
            throw new KernelException( 'Can not run a query that references the <strong>' . $this->_model . '</strong> datas', $e->getCode(), $e );
        }
    }
}