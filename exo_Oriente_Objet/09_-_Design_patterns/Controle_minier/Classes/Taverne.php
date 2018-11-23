<?php 

Class Taverne {
    /***************************************************************************************************
 *                                       ATTRIBUTS
****************************************************************************************************/
     // ID - Nom - Chambres - Blonde - Brune - Rousse - Ville_fk
      /**
       * ID de la taverne
       *
       * @var int 
       */
      private $_id;
      /**
       * NOM de la taverne
       *
       * @var STRING 
       */
      private $_nom;
      /**
       * Nombres de chambres de la taverne
       *
       * @var int 
       */
      private $_chambres;
      /**
       * Bières disponible dans la taverne
       *
       * @var string 
       */
      private $_bieres;
      /**
       * Ville où est situé la taverne
       *
       * @var int 
       */
      private $_ville_fk;
       /**
       * Ville où est situé la taverne
       *
       * @var string 
       */
      private $_ville;
      /**
       * Nombres de Chambres libres de la taverne
       *
       * @var int
       */
      private $_chambresLibres;
    


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
     * Get iD de la taverne
     *
     * @return  int
     */ 
    public function get_id(){ return $this->_id;}

    /**
     * Get nOM de la taverne
     *
     * @return  STRING
     */ 
    public function get_nom(){ return $this->_nom;}

    /**
     * Get nombres de chambres de la taverne
     *
     * @return  int
     */ 
    public function get_chambres(){ return $this->_chambres;}

    /**
     * Get bières disponible dans la taverne
     *
     * @return  string
     */ 
    public function get_bieres(){ return $this->_bieres;}

    /**
     * Get ville où est situé la taverne
     *
     * @return  int
     */ 
    public function get_ville_fk(){ return $this->_ville_fk;}

    /**
     * Get nombres de Chambres libres de la taverne
     *
     * @return  int
     */ 
    public function get_chambresLibres(){ return $this->_chambresLibres;}
    
    /**
     * Get ville où est situé la taverne
     *
     * @return  string
     */ 
    public function get_ville(){ return $this->_ville;}
    

/***************************************************************************************************
*                                       SETTERS
****************************************************************************************************/
  /**
       * Set iD de la taverne
       *
       * @param  int  $_id  ID de la taverne
       *
       * @return  self
       */ 
      public function set_id(int $_id){
        $this->_id = $_id;

        return $this;
  }

  /**
   * Set nOM de la taverne
   *
   * @param  STRING  $_nom  NOM de la taverne
   *
   * @return  self
   */ 
  public function set_nom(STRING $_nom){
        $this->_nom = $_nom;

        return $this;
  }

  /**
   * Set nombres de chambres de la taverne
   *
   * @param  int  $_chambres  Nombres de chambres de la taverne
   *
   * @return  self
   */ 
  public function set_chambres(int $_chambres){
        $this->_chambres = $_chambres;

        return $this;
  }

  /**
   * Set bières disponible dans la taverne
   *
   * @param  string  $_bieres  Bières disponible dans la taverne
   *
   * @return  self
   */ 
  public function set_bieres(string $_bieres){
    switch ($_bieres) {
      case "1 0 0":
        $_bieres = 'Blonde';
        break;
      case "0 1 0":
        $_bieres = 'Brune';
        break;
      case "0 0 1":
        $_bieres = 'Rousse';
        break;
      case "0 1 1":
        $_bieres ='Brune | Rousse';
        break;
      case "1 0 1":
        $_bieres ='Blonde | Rousse';
        break;
      case "1 1 1":
        $_bieres = 'Blonde | Brune | Rousse';
        break;
      case "1 1 0":
        $_bieres ='Blonde | Brune';
        break;

    }
        $this->_bieres = $_bieres;

        return $this;
  }

  /**
   * Set ville où est situé la taverne
   *
   * @param  int  $_ville_fk  Ville où est situé la taverne
   *
   * @return  self
   */ 
  public function set_ville_fk(int $_ville_fk){
        $this->_ville_fk = $_ville_fk;

        return $this;
  }

  /**
   * Set nombres de Chambres libres de la taverne
   *
   * @param  int  $_chambresLibres  Nombres de Chambres libres de la taverne
   *
   * @return  self
   */ 
  public function set_chambresLibres(int $_chambresLibres){
        $this->_chambresLibres = $_chambresLibres;

        return $this;
  }
  
  /**
   * Set ville où est situé la taverne
   *
   * @param  string  $_ville  Ville où est situé la taverne
   *
   * @return  self
   */ 
  public function set_ville(string $_ville) {
    $this->_ville = $_ville;

    return $this;
}
      
     

/***************************************************************************************************
  *                                       Functions
****************************************************************************************************/

  

   


}