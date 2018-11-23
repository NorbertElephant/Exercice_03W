<?php 

Class Tunnel {
    /***************************************************************************************************
 *                                       ATTRIBUTS
****************************************************************************************************
    /**
     * ID de la Tunnel
     *
     * @var int
     */
     private $_id;

     /**
     * Progression du Tunnel
     *
     * @var int
     */
     private $_progres;

    /**
     * Ville de Départ du Tunnel
     *
     * @var int
     */
     private $_villedepart_fk;

     /**
     * Ville de Arrivée du Tunnel
     *
     * @var int
     */
    private $_villearrivee_fk;
     /**
      * 
     * Nom Ville de Arrivée du Tunnel
     *
     * @var string
     */
    private $_nom_villedepart;
    
    /**
     * Nom Ville de Arrivée du Tunnel
     *
     * @var string
     */
    private $_nom_villearrivee;
    


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
      * Get iD de la Tunnel
      *
      * @return  int
      */ 
      public function get_id(){return $this->_id;}

      /**
       * Get progression du Tunnel
       *
       * @return  int
       */ 
      public function get_progres(){return $this->_progres;}
 
      /**
       * Get ville de Départ du Tunnel
       *
       * @return  int
       */ 
      public function get_villedepart_fk(){return $this->_villedepart_fk;}
 
     /**
      * Get ville de Arrivée du Tunnel
      *
      * @return  int
      */ 
     public function get_villearrivee_fk(){return $this->_villearrivee_fk;}
         /**
     * Get nom Ville de Arrivée du Tunnel
     *
     * @return  string
     */ 
    public function get_nom_villedepart(){return $this->_nom_villedepart; }
       /**
     * Get nom Ville de Arrivée du Tunnel
     *
     * @return  string
     */ 
    public function get_nom_villearrivee(){ return $this->_nom_villearrivee; }

     
/***************************************************************************************************
*                                       SETTERS
****************************************************************************************************/
    /**
     * Set iD de la Tunnel
    *
    * @param  int  $_id  ID de la Tunnel
    *
    * @return  self
    */ 
    public function set_id(int $_id){
        $this->_id = $_id;

        return $this;
    }
   /**
     * Set progression du Tunnel
    *
    * @param  int  $_progres  Progression du Tunnel
    *
    * @return  self
    */ 
    public function set_progres(int $_progres){
        $this->_progres = $_progres;

        return $this;
    }

  /**
     * Set ville de Départ du Tunnel
    *
    * @param  int  $_villedepart_fk  Ville de Départ du Tunnel
    *
    * @return  self
    */ 
    public function set_villedepart_fk(int $_villedepart_fk){
        $this->_villedepart_fk = $_villedepart_fk;

        return $this;
    }
 
  /**
     * Set ville de Arrivée du Tunnel
     *
     * @param  int  $_villearrivee_fk  Ville de Arrivée du Tunnel
     *
     * @return  self
     */ 
    public function set_villearrivee_fk(int $_villearrivee_fk){
        $this->_villearrivee_fk = $_villearrivee_fk;

        return $this;
    } 
    /**
     * Set nom Ville de Arrivée du Tunnel
     *
     * @param  string  $_nom_villedepart  Nom Ville de Arrivée du Tunnel
     *
     * @return  self
     */ 
    public function set_nom_villedepart(string $_nom_villedepart){
      $this->_nom_villedepart = $_nom_villedepart;

      return $this;
  }
    /**
     * Set nom Ville de Arrivée du Tunnel
     *
     * @param  string  $_nom_villearrivee  Nom Ville de Arrivée du Tunnel
     *
     * @return  self
     */ 
    public function set_nom_villearrivee(string $_nom_villearrivee){
        $this->_nom_villearrivee = $_nom_villearrivee;

        return $this;
    }    
     

/***************************************************************************************************
  *                                       Functions
****************************************************************************************************/


  

    

   

   

  

  
    



    
}