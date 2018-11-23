<?php 

Class Ville {
    /***************************************************************************************************
 *                                       ATTRIBUTS
****************************************************************************************************/
     // ID - Nom - Superficie
    /**
     * ID de la Ville
     *
     * @var int
     */
     private $_id;

     /**
     * Nom de la Ville
     *
     * @var string
     */
     private $_nom;

    /**
     * Superficie de la Ville
     *
     * @var int
     */
     private $_superficie;
    


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
  * Get iD de la Ville
  *
  * @return  int
  */ 
  public function get_id(){ return $this->_id;}

  /**
   * Get nom de la Ville
   *
   * @return  string
   */ 
  public function get_nom(){ return $this->_nom;}

  /**
   * Get superficie de la Ville
   *
   * @return  int
   */ 
  public function get_superficie(){ return $this->_superficie;}   

/***************************************************************************************************
*                                       SETTERS
****************************************************************************************************/
   /**
      * Set iD de la Ville
      *
      * @param  int  $_id  ID de la Ville
      *
      * @return  self
      */ 
      public function set_id(int $_id){
        $this->_id = $_id;

        return $this;
   }

   /**
    * Set nom de la Ville
    *
    * @param  string  $_nom  Nom de la Ville
    *
    * @return  self
    */ 
   public function set_nom(string $_nom){
        $this->_nom = $_nom;

        return $this;
   }

   /**
    * Set superficie de la Ville
    *
    * @param  int  $_superficie  Superficie de la Ville
    *
    * @return  self
    */ 
   public function set_superficie(int $_superficie){
        $this->_superficie = $_superficie;

        return $this;
   }
       
  
     

/***************************************************************************************************
  *                                       Functions
****************************************************************************************************/


  
}