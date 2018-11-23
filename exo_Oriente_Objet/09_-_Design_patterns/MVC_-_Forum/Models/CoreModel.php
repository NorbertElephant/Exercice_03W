<?php 

Abstract class CoreModel {

/***************************************************************************************************
 *                                       ATTRIBUTS
****************************************************************************************************/ 
  
    /** Login / mdp pour connection a la BDD 
     * @var string $_db
     */
    protected $_db; 

    /** Login / mdp pour connection a la BDD 
     * @var string $_db
     */
    protected $_requete; 


/*****************************************************************************************************
 *                                       MAGIC
****************************************************************************************************/
    public function __construct($instance){
        try{
            $this->_db= $instance;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(),$e->getCode(),$e);
        }   
    }


    public function __destruct(){
        if(!empty($this->_requete)){
            $this->_requete->closecursor();
        }
    }



}
