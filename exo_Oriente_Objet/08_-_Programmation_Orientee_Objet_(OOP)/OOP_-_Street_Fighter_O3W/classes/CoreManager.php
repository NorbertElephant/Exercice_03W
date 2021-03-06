<?php 
/**
 * ------------------------------------------------------------
 * 
 * ------------------------------------------------------------
**/

 abstract class CoreManager {

     /**
     * --------------------------------------------------
     * ATTRIBUTS
     * --------------------------------------------------
    **/
    protected $_db;

    /**
     * --------------------------------------------------
     * MAGIC METHODS
     * --------------------------------------------------
    **/
    /**
     * __construct - Class constructor
     * @param   PDO     $instance
     * @return  
    **/
    public function __construct( $instance ) {
        $this->_db = $instance; // Defines PDO instance
    }



    /**
     * --------------------------------------------------
     * SETTERS
     * --------------------------------------------------
    **/



    /**
     * --------------------------------------------------
     * GETTERS
     * --------------------------------------------------
    **/
    /**
     * getDb - 
     * @param   
     * @return  
    **/
    protected function getDb() {
        return $this->_db;
    }




 }