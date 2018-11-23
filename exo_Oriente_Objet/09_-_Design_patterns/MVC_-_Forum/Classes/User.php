<?php
class User {
/***************************************************************************************************
 *                                       ATTRIBUTS
****************************************************************************************************/
  /**
   * Identifiant de l'utilisateur
   * @var integer
   */
  private $_id;
  /**
   * Nom d'utilisateur
   * @var string
   */
  private $_login;
 
  /**
   * Nom de l'utilisateur
   * @var string
   */
  private $_nom;
  /**
   * Prénom de l'utilisateur
   * @var string
   */
  private $_prenom;
  /**
   * Prénom de l'utilisateur
   * @var string
   */
  private $_date_naissance;
  /**
   * Prénom de l'utilisateur
   * @var string
   */
  private $_date_inscription;
  /**
   * Rôle de l'utilisateur
   * @var integer
   */
  private $_rang;

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
      $methodName = 'set_' . $key;
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
     * Get identifiant de l'utilisateur
     * @return  integer
     */ 
    public function get_id(){ return $this->_id;}
     /**
   * Get login d'utilisateur
    * @return  string
    */ 
    public function get_login(){return $this->_login;}
    /**
     * Get nom de l'utilisateur
     * @return  string
     */ 
    public function get_nom(){return $this->_nom;}
    /**
     * Get prénom de l'utilisateur
     * @return  string
     */ 
    public function get_prenom(){return $this->_prenom;}
    /**
     * Get date naissance de l'utilisateur
     * @return  string
     */ 
    public function get_date_naissance() {return $this->_date_naissance;}
    /**
     * Get date inscription de l'utilisateur
     * @return  string
     */ 
    public function get_date_inscription(){return $this->_date_inscription;}
    /**
     * Get rôle de l'utilisateur
     *
     * @return  integer
     */ 
    public function get_rang(){return $this->_rang;}
/***************************************************************************************************
*                                       SETTERS
****************************************************************************************************/
    /**
     * Set identifiant de l'utilisateur
     * @param  integer  $_id  Identifiant de l'utilisateur
     * @return  self
     */ 
    public function set_id($_id) {
        $this->_id = $_id;

        return $this;
    }

    /**
     * Set nom d'utilisateur
     * @param  string  $_login  Nom d'utilisateur
     * @return  self
     */ 
    public function set_login(string $_login){
        $this->_login = $_login;

        return $this;
    }

    /**
     * Set nom de l'utilisateur
     * @param  string  $_nom  Nom de l'utilisateur
     * @return  self
     */ 
    public function set_nom(string $_nom){
        $this->_nom = $_nom;

        return $this;
    }

    /**
     * Set prénom de l'utilisateur
     * @param  string  $_prenom  Prénom de l'utilisateur
     * @return  self
     */ 
    public function set_prenom(string $_prenom){
        $this->_prenom = $_prenom;

        return $this;
    }

    /**
     * Set prénom de l'utilisateur
     * @param  string  $_date_naissance  Prénom de l'utilisateur
     * @return  self
     */ 
    public function set_date_naissance(string $_date_naissance){
        $this->_date_naissance = $_date_naissance;

        return $this;
    }

    /**
     * Set prénom de l'utilisateur
     * @param  string  $_date_inscription  Prénom de l'utilisateur
     * @return  self
     */ 
    public function set_date_inscription(string $_date_inscription){
        $this->_date_inscription = $_date_inscription;

        return $this;
    }

    /**
     * Set rôle de l'utilisateur
     * @param  integer  $_rang  Rôle de l'utilisateur
     * @return  self
     */ 
    public function set_rang($_rang){
        $this->_rang = $_rang;

        return $this;
    }
}
