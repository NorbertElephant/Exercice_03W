<?php

class message {

/***************************************************************************************************
 *                                       ATTRIBUTS
****************************************************************************************************/
/** identifiant message
 * @var int $_id
 */
Private $_id;

/** Contenu du message
 * @var string $_contenu
 */
Private $_contenu;

/** date d'écriture du message
 * @var string $_date
 */
Private $_date;

/** Heure d'écriture du message
 * @var string $_time
 */
Private $_time;


/** Nom + prénom de l'auteur
 * @var string $_nom
 */
Private $_nom;

/** Nombres de messages
 * @var string $_numbers
 */
Private $_numbers;

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
    public function get_id(){ return $this->_id; }
    
    /**
     * Get $_contenu
     *
     * @return  string
     */ 
    public function get_contenu(){return $this->_contenu;}

     /**
     * Get $_date
     *
     * @return  string
     */ 
    public function get_date() {return $this->_date;}

    /**
     * Get $_time
     *
     * @return  string
     */ 
    public function get_time() {return $this->_time;}

        /**
     * Get $_nom
     *
     * @return  string
     */ 
    public function get_nom(){return $this->_nom;}

    /**
     * Get $_numbers
     *
     * @return  string
     */ 
    public function get_numbers(){return $this->_numbers;}

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
    public function set_id( $_id){
    $this->_id = $_id;

    return $this;
    }

    /**
     * Set $_contenu
     *
     * @param  string  $_contenu  $_contenu
     *
     * @return  self
     */ 
    public function set_contenu(string $_contenu){
    $this->_contenu = $_contenu;

    return $this;
    }

    /**
     * Set $_time
     *
     * @param  string  $_time  $_time
     *
     * @return  self
     */ 
    public function set_date(string $_date){
        $date = substr($_date,0,10); 
        $time = substr($_date, 11,19); 
        
        $this->_date = $date;

        $this->_time = $time;

        return $this;
    }

    /**
     * Set $_nom
     *
     * @param  string  $_nom  $_nom
     *
     * @return  self
     */ 
    public function set_nom(string $_nom){
    $this->_nom = $_nom;

    return $this;
    }

    /**
     * Set $_numbers
     *
     * @param  string  $_numbers  $_numbers
     *
     * @return  self
     */ 
    public function set_numbers(string $_numbers)
    {
    $this->_numbers = $_numbers;

    return $this;
    }
}