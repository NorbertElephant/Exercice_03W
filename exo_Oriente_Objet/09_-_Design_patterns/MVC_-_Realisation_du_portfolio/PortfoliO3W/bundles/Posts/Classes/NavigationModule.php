<?php
// METTRE AU PROPRE : Params / Setters / Getters / Returns / Visibilité
/**
 * ------------------------------------------------------------
 * NAVIGATION MODULE
 * ------------------------------------------------------------
**/
class NavigationModule {
    /**
     * --------------------------------------------------
     * PROPERTIES
     * --------------------------------------------------
    **/
    private $_tag;
    private $_class;
    private $_items;



    /**
     * --------------------------------------------------
     * MAGIC METHODS
     * --------------------------------------------------
    **/
    /**
     * __construct - Class constructor
     * @param   string  $id
     *          string  $class
     * @return
    **/
    public function __construct( $id, $class ) {
        $this->_tag = $tag;
        $this->_class = $class;
    }



    /**
     * --------------------------------------------------
     * SETTERS
     * --------------------------------------------------
    **/
    /**
     * setTag -
     * @param   string  $value
     * @return
    **/
    public function setTag( $value ) {
        $this->_tag = $value;
    }

    /**
     * setClass -
     * @param   string  $value
     * @return
    **/
    public function setClass( $value ) {
        $this->_class = $value;
    }



    /**
     * --------------------------------------------------
     * GETTERS
     * --------------------------------------------------
    **/
    /**
     * getTag -
     * @param
     * @return
    **/
    public function getTag() {
        return $this->_tag;
    }

    /**
     * getClass -
     * @param
     * @return
    **/
    public function getClass() {
        return $this->_class;
    }



    /**
     * --------------------------------------------------
     * METHODS
     * --------------------------------------------------
    **/
}