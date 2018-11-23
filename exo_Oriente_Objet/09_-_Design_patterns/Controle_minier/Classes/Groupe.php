<?php 

Class Groupe {
    /***************************************************************************************************
 *                                       ATTRIBUTS
****************************************************************************************************/
     // ID - debuttravail - fintravail - taverne_fk - tunnel_fk - NbreNains - Nom Taverne
    /**
     * ID du groupe
     *
     * @var Int
     */
    private $_id;

    /**
     * Heure de début de travail format : 00:00:00
     *
     * @var string
     */
    private $_debuttravail;

     /**
     * Heure de fin de travail format : 00:00:00
     *
     * @var string
     */
    private $_fintravail;

    /**
     * ID de la taverne affilié au Groupe
     *
     * @var Int
     */
    private $_taverne_fk;

    /**
     * ID du tunnel affilié au groupe 
     *
     * @var Int
     */
    private $_tunnel_fk;

    /**
     * Nom de la taverne affilié au groupe 
     *
     * @var string
     */
    private $_nom_taverne;

    /**
     * Nombres de Nains qui composent le groupe
     *
     * @var Int
     */
    private $_nbreNains;

    /***************************************************************************************************
  *                                       HYDRATE
  ****************************************************************************************************/
 /**
   * Hydratation
   *
   * @param array $data
   * @return void
   */
  public function hydrate(array $data) {
    foreach( $data as $key=>$value ) {
      if ($value === NULL) {
      $value = '';
      }
    }
    foreach( $data as $key=>$value ) {
        $methodName = 'set' .substr($key,1);
      if(method_exists($this, $methodName)) {
        $this->$methodName($value);
      }
    }
  }
/***************************************************************************************************
  *                                       MAGIC
  ****************************************************************************************************/
  /**
   * Constructeur
   *
   * @param array $data
   */
  public function __construct(array $data) {
    $this->hydrate($data);
  }

/***************************************************************************************************
 *                                       GETTERS
****************************************************************************************************/
  /**
   * Get iD du groupe
   *
   * @return  Int
   */ 
  public function get_id(){return $this->_id;}

  /**
   * Get heure de début de travail format : 00:00:00
   *
   * @return  string
   */ 
  public function get_debuttravail(){return $this->_debuttravail;}

  /**
   * Get heure de fin de travail format : 00:00:00
   *
   * @return  string
   */ 
  public function get_fintravail(){return $this->_fintravail;}

  /**
   * Get iD de la taverne affilié au Groupe
   *
   * @return  Int
   */ 
  public function get_taverne_fk(){return $this->_taverne_fk;}

  /**
   * Get iD du tunnel affilié au groupe
   *
   * @return  Int
   */ 
  public function get_tunnel_fk(){return $this->_tunnel_fk;}

  /**
   * Get nom de la taverne affilié au groupe
   *
   * @return  string
   */ 
  public function get_nom_taverne(){return $this->_nom_taverne;}

  /**
   * Get nombres de Nains qui composent le groupe
   *
   * @return  Int
   */ 
  public function get_nbreNains(){return $this->_nbreNains;}

/***************************************************************************************************
*                                       SETTERS
****************************************************************************************************/
/**
   * Set iD du groupe
   *
   * @param  Int  $_id  ID du groupe
   *
   * @return  self
   */ 
  public function set_id(Int $_id){
    $this->_id = $_id;

    return $this;
}

/**
 * Set heure de début de travail format : 00:00:00
 *
 * @param  string  $_debuttravail  Heure de début de travail format : 00:00:00
 *
 * @return  self
 */ 
public function set_debuttravail(string $_debuttravail){
    $this->_debuttravail = $_debuttravail;

    return $this;
}

/**
 * Set heure de fin de travail format : 00:00:00
 *
 * @param  string  $_fintravail  Heure de fin de travail format : 00:00:00
 *
 * @return  self
 */ 
public function set_fintravail(string $_fintravail){
    $this->_fintravail = $_fintravail;

    return $this;
}

/**
 * Set iD de la taverne affilié au Groupe
 *
 * @param  Int  $_taverne_fk  ID de la taverne affilié au Groupe
 *
 * @return  self
 */ 
public function set_taverne_fk( $_taverne_fk){
    $this->_taverne_fk = $_taverne_fk;

    return $this;
}

/**
 * Set iD du tunnel affilié au groupe
 *
 * @param  Int  $_tunnel_fk  ID du tunnel affilié au groupe
 *
 * @return  self
 */ 
public function set_tunnel_fk(Int $_tunnel_fk){
    $this->_tunnel_fk = $_tunnel_fk;

    return $this;
}

/**
 * Set nom de la taverne affilié au groupe
 *
 * @param  string  $_nom_taverne  Nom de la taverne affilié au groupe
 *
 * @return  self
 */ 
public function set_nom_taverne( $_nom_taverne){
    $this->_nom_taverne = $_nom_taverne;

    return $this;
}

/**
 * Set nombres de Nains qui composent le groupe
 *
 * @param  Int  $_nbreNains  Nombres de Nains qui composent le groupe
 *
 * @return  self
 */ 
public function set_nbreNains(Int $_nbreNains){
    $this->_nbreNains = $_nbreNains;

    return $this;
}
       
  
     

/***************************************************************************************************
  *                                       Functions
****************************************************************************************************/

    

    
}