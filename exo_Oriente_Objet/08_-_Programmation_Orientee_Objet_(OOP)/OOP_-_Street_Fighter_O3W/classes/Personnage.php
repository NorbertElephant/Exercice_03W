<?php 

/**
 * ------------------------------------------------------------
 * 
 * ------------------------------------------------------------
**/
class Personnage {

    /**
     * --------------------------------------------------
     * CONSTANTS
     * --------------------------------------------------
    **/
    const HP = 100;

     /**
     * --------------------------------------------------
     * ATTRIBUTS
     * --------------------------------------------------
    **/

    private $_id;

    private $_name;

    private $_hp;


    /**
     * --------------------------------------------------
     * HYDRATE
     * --------------------------------------------------
    **/
    public function hydrate(array $data) {
        foreach( $data as $key=>$value ) {
            $methodName = 'set' . substr($key,3);
            if(method_exists($this, $methodName)) {
              $this->$methodName($value);
            }
          }
    }


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
    public function __construct(array $data) {
       $this->hydrate($data);
    }

     /**
     * --------------------------------------------------
     * GETTERS
     * --------------------------------------------------
    **/
     /**
     * Get the value of _id
     */ 
    public function get_id(){ return $this->_id;}

     /**
     * Get the value of _name
     */ 
    public function get_name(){ return $this->_name;}

    /**
     * Get the value of _hp
     */ 
    public function get_hp(){ return $this->_hp;}

    /**
     * --------------------------------------------------
     * SETTERS
     * --------------------------------------------------
    **/

     /**
     * Set the value of _id
     *
     * @return  self
     */ 
    public function set_id( int $_id){
        $this->_id = $_id;

        return $this;
    }

    /**
     * Set the value of _name
     *
     * @return  self
     */ 
    public function set_name(string $_name){
        $this->_name = $_name;

        return $this;
    }

    /**
     * Set the value of _hp
     *
     * @return  self
     */ 
    public function set_hp(int $_hp){
        $this->_hp = $_hp;

        return $this;
    }


     /**
     * --------------------------------------------------
     * METHODS
     * --------------------------------------------------
    **/

    public function Frapper ( $defenseur ){ // vérification de ne pas se frapper 
        if ($this !== $defenseur ) {

            return true;

            } return false;
            
    }

    
    public function degats() {
        return mt_rand(0,25);
    }

   public function recevoir_degat( $degats){
    
        return $this->get_hp() - $degats;

   }


   
}
