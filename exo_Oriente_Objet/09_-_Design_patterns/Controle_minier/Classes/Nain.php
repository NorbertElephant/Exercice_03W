<?php 

Class Nain {

/***************************************************************************************************
 *                                       ATTRIBUTS
****************************************************************************************************/

  /**
   * ID du Nain
   *
   * @var int $_id
   */
     private $_id;

     /**
   * Nom du Nain
   *
   * @var string $_nom
   */
     private $_nom;

     /**
   * Longueur de la barbe du Nain
   *
   * @var int $_barbe
   */
     private $_barbe;
     
    /**
     * Ville ou est le  Nain
     *
     * @var int $_ville_fk
     */
     private $_ville_fk;

     /**
     * Groupe dont appartient le  Nain
     *
     * @var int $_groupe_fk
     */
     private $_groupe_fk;

     /**
     * Ville Natale ou est le  Nain
     *
     * @var string $_nom_ville
     */
      private $_nom_ville;

      /**
     * Nom de la Taverne où boit le  Nain
     *
     * @var string $_nom_taverne
     */
      private $_nom_taverne;
       /**
     * id de la Taverne où boit le  Nain
     *
     * @var string $_id_taverne
     */
    private $_id_taverne;
    
      /**
     * Heure du travail du  Nain
     *
     * @var string $_nom_taverne
     */
    private $_heure_travail;

      /**
       * Nom de départ de la ville ou le nain travail dans le Tunnel
       *
       * @var string $_tunnel_travail
       */
      private $_villedepart;

      /**
     * Nom de départ de la ville ou le nain travail dans le Tunnel
     *
     * @var string $_tunnel_travail
     */
    private $_villearrivee;
    
    /**
     * Nom de départ de la ville ou le nain travail dans le Tunnel
     *
     * @var int $_tunnel_travail
     */
    private $_villedepart_fk;
      /**
     * Nom de départ de la ville ou le nain travail dans le Tunnel
     *
     * @var int $_tunnel_travail
     */
    private $_villearrivee_fk;


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
    * Get the value of _id
    */ 
    public function get_id(){ return $this->_id;}

    /**
    * Get the value of _nom
    */ 
    public function get_nom(){ return $this->_nom;}

    /**
    * Get the value of _barbe
    */ 
    public function get_barbe(){ return $this->_barbe;}

    /**
    * Get the value of _ville_fk
    */ 
    public function get_ville_fk(){ return $this->_ville_fk;}

    /**
    * Get the value of _groupe_fk
    */ 
    public function get_groupe_fk(){ return $this->_groupe_fk;}

    /**
     * Get $_nom_ville
     *
     * @return  string
     */ 
    public function get_nom_ville(){ return $this->_nom_ville;}

    /**
     * Get $_nom_taverne
     *
     * @return  string
     */ 
    public function get_nom_taverne(){ return $this->_nom_taverne; }
       /**
     * Get $_id_taverne
     *
     * @return  id
     */ 
    public function get_id_taverne(){ return $this->_id_taverne; }

    /**
     * Get $_nom_taverne
     *
     * @return  string
     */ 
    public function get_heure_travail(){return $this->_heure_travail;}
    /**
       * Get $_villedepart
       *
       * @return  string
       */ 
      public function get_villedepart(){return $this->_villedepart;}
       /**
       * Get $_villedepart
       *
       * @return  string
       */ 
      public function get_villearrivee(){return $this->_villearrivee;}
      
    /**
     * Get $_tunnel_travail
     *
     * @return  int
     */ 
    public function get_villedepart_fk(){ return $this->_villedepart_fk;}
    
    /**
     * Get $_tunnel_travail
     *
     * @return  int
     */ 
    public function get_villearrivee_fk(){return $this->_villearrivee_fk;}



/***************************************************************************************************
*                                       SETTERS
****************************************************************************************************/
    /**
    * Set the value of _id
    *
    * @return  self
    */ 
    public function set_id($_id){
          $this->_id = $_id;

          return $this;
    }

    /**
     * Set the value of _nom
     *
     * @return  self
     */ 
    public function set_nom($_nom) {
          $this->_nom = $_nom;

          return $this;
    }

    /**
     * Set the value of _barbe
     *
     * @return  self
     */ 
    public function set_barbe($_barbe){
          $this->_barbe = $_barbe;

          return $this;
    }

    /**
     * Set the value of _ville_fk
     *
     * @return  self
     */ 
    public function set_ville_fk($_ville_fk){
          $this->_ville_fk = $_ville_fk;

          return $this;
    }

    /**
     * Set the value of _groupe_fk
     *
     * @return  self
     */ 
    public function set_groupe_fk($_groupe_fk){
          $this->_groupe_fk = $_groupe_fk;

          return $this;
    }
     /**
     * Set $_nom_ville
     *
     * @param  string  $_nom_ville  $_nom_ville
     *
     * @return  self
     */ 
    public function set_nom_ville(string $_nom_ville){
      $this->_nom_ville = $_nom_ville;

      return $this;
    }
    /**
     * Set $_nom_taverne
     *
     * @param  string  $_nom_taverne  $_nom_taverne
     *
     * @return  self
     */ 
    public function set_nom_taverne(string $_nom_taverne ){
      
      $this->_nom_taverne = $_nom_taverne;

      return $this;
    }
    /**
     * Set $_id_taverne
     *
     * @param  int  $_nid_taverne
     *
     * @return  self
     */ 
    public function set_id_taverne( $_id_taverne ){
      $this->_id_taverne = $_id_taverne;

      return $this;
    }

    /**
     * Set $_nom_taverne
     *
     * @param  string  $_heure_travail  $_nom_taverne
     *
     * @return  self
     */ 
    public function set_heure_travail(string $_heure_travail){
        $this->_heure_travail = $_heure_travail;

        return $this;
    }
  
    /**
     * Set $_tunnel_travail
     *
     * @param  string  $_tunnel_travail  $_tunnel_travail
     *
     * @return  self
     */ 
    public function set_villedepart(string $_villedepart){
      $this->_villedepart = $_villedepart;

      return $this;
    }
   /**
     * Set $_tunnel_travail
     *
     * @param  string  $_villearrivee  $_tunnel_travail
     *
     * @return  self
     */ 
    public function set_villearrivee(string $_villearrivee)
    {
        $this->_villearrivee = $_villearrivee;

        return $this;
    }
    
    /**
     * Set $_tunnel_travail
     *
     * @param  int  $_villedepart_fk  $_tunnel_travail
     *
     * @return  self
     */ 
    public function set_villedepart_fk(int $_villedepart_fk) {
      $this->_villedepart_fk = $_villedepart_fk;

      return $this;
  }
  /**
     * Set $_tunnel_travail
     *
     * @param  int  $_villearrivee_fk  $_tunnel_travail
     *
     * @return  self
     */ 
    public function set_villearrivee_fk(int $_villearrivee_fk) {
      $this->_villearrivee_fk = $_villearrivee_fk;

      return $this;
  }
      

/***************************************************************************************************
  *                                       Functions
****************************************************************************************************/
  
     

  

    

     

    

    


      

     

   




    
}