<?php 
/**
 *  Class Conversation 
 */

class conversation {
 /***************************************************************************************************
  *                                       ATTRIBUTS
  ****************************************************************************************************/   

    /**  Identifiant 
     * @var int $_id
     */
    Private $_id;

    /**  Date de la conversation 
    * @var string $_date
    */
    Private $_date;
    
     /**  Heure de la conversation 
    * @var string $_time
    */
    Private $_time;

    /** Nombres de messages
     *  @var int $_numbers
     */
    Private $_numbers;

     /** Terminé ou non 
     *  @var int $_termine
     */
    Private $_termine;

/***************************************************************************************************
  *                                       HYDRATE
  ****************************************************************************************************/

    // HYDRATATION -> Permet d'injecter des données de BDD à un objet
    public function hydrate(array $datas) {
        foreach ($datas as $key => $value) {
            // on récupère le nom du stter correspondant à l'attribut
            $method = 'set_'.$key;
            if(method_exists($this, $method)) {
                // On appelle les setter
                $this->$method($value); 
            }
        }
    }


 /***************************************************************************************************
  *                                       MAGIC
  ****************************************************************************************************/
    public function __construct(array $datas ){
        $this->hydrate($datas);
    }

 /***************************************************************************************************
  *                                       GETTERS
  ****************************************************************************************************/

    /**
     * Get $_id
     *
     * @return  int
     */ 
    public function get_id() { return $this->_id; }
    /**
     * Get $_date
     *
     * @return  string
     */ 
    public function get_date() { return $this->_date; }

    /**
     * Get $_time
     *
     * @return  string
     */ 
    public function get_time(){ return $this->_time;}

      /**
     * Get $_numbers
     *
     * @return  int
     */ 
    public function get_numbers() { return $this->_numbers;}

    /**
     * Get $_termine
     *
     * @return  int
     */ 
    public function get_termine() { return $this->_termine;}



 /***************************************************************************************************
  *                                       SETTERS
  ****************************************************************************************************/
    
    /**
     * Set $_id
     *
     * @param  int  $_id  $_id
     *
     * @return  self
     */ 
    public function set_id(int $_id){
            $this->_id = $_id;
    
        return $this;
    }

    /**
     * Set $_date + $_time
     *
     * @param  string  $_date  $_date
     *
     * @return  self
     */ 
    public function set_date(string $_date) {
        $date = substr($_date,0,10); 
        $time = substr($_date, 11,19); 
        
        $this->_date = $date;

        $this->_time = $time;

        return $this;
    }

  
    /**
     * Set $_numbers
     *
     * @param  int  $_numbers  $_numbers
     *
     * @return  self
     */ 
    public function set_numbers(int $_numbers) {
            $this->_numbers = $_numbers;
    
        return $this;
    }

    /**
     * Set $_termine
     *
     * @param  int  $_termine  $_termine
     *
     * @return  self
     */ 
    public function set_termine(int $_termine){
        $this->_termine = $_termine;

        return $this;
    }
}