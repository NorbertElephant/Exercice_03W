<?php 

class VilleModel extends coreModel {
/***************************************************************************************************
  *                                       MAGIC 
  ****************************************************************************************************/
    /**
     * __construct - Class constructor
     * @param   PDO     $instance
     * @return  
    **/
    public function __construct( $instance ) {
        try {
            parent::__construct( $instance );
        } catch( PDOException $e ) {
            throw new CoreException( $e->getMessage() );
        } 
    }

/***************************************************************************************************
  *                                       GETTERS
  ****************************************************************************************************/
    /**
     * Get $_db
     *
     * @return  string
     */ 
    public function get_db(){ return $this->_db; }

/***************************************************************************************************
  *                                       CREATE  
****************************************************************************************************/

/***************************************************************************************************
  *                                       READ 
****************************************************************************************************/


public function ReadAll() {
    try {
        if(($this->_requete = $this->_db->query('SELECT `VILLE`.*
                                                FROM `VILLE`
                                                ')) !==false) {
            $villes = array();

                while( ($data = $this->_requete->fetch(PDO::FETCH_ASSOC) ) !== false ){
        
                $villes[] =new Nain($data);
                } return $villes;
            } return false ;
    } catch (PDOException $e) {
        throw new Exception($e->getMessage(),$e->getCode(),$e);
        }
}

public function ReadOne($id) {
    try {
            if(($this->_requete = $this->_db->prepare('SELECT `VILLE`.* 
                                                    FROM `VILLE`
                                                    WHERE `v_id`=:id
                                                    ')) !==false) {
                if($this->_requete->bindValue('id', $id)){
                    if($this->_requete->execute()) {
                        if(($data = $this->_requete->fetch(PDO::FETCH_ASSOC))!==false) {
                            $ville = new Ville($data);
                            return $ville ;
                        } 
                    } 
                } return false;
            }   
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(),$e->getCode(),$e);
            }
    }


/***************************************************************************************************
  *                                       UPDATE 
****************************************************************************************************/
/***************************************************************************************************
  *                                       DELETE 
****************************************************************************************************/

}