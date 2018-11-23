<?php 

class TaverneModel extends coreModel {
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
        if(($this->_requete = $this->_db->query('SELECT `TAVERNE`.* , `t_chambres`- COUNT(`n_id`) AS`t_chambresLibres`, CONCAT(`t_blonde`, " ",`t_brune`, " ",`t_rousse`) AS `t_bieres`, `v_nom` AS `v_ville`
                                                FROM `TAVERNE`
                                                LEFT JOIN `GROUPE` ON `TAVERNE`.`t_id`= `GROUPE`.`g_taverne_fk`
                                                LEFT JOIN `NAIN` ON `GROUPE`.`g_id` = `NAIN`.`n_groupe_fk`
                                                LEFT JOIN `VILLE` ON `TAVERNE`.`t_ville_fk`= `VILLE`.`v_id`
                                                GROUP BY `TAVERNE`.`t_id`
                                                ')) !==false) {
            $tavernes = array();

                while( ($data = $this->_requete->fetch(PDO::FETCH_ASSOC) ) !== false ){
        
                $tavernes[] =new Taverne($data);
                } return $tavernes;
            } return false ;
    } catch (PDOException $e) {
        throw new Exception($e->getMessage(),$e->getCode(),$e);
        }
}
public function ReadOne($id) {
try {
        if(($this->_requete = $this->_db->prepare('SELECT `TAVERNE`.* , `t_chambres`- COUNT(`n_id`) AS`t_chambresLibres`, CONCAT(`t_blonde`, " ",`t_brune`, " ",`t_rousse`) AS `t_bieres`, `v_nom` AS `v_ville`
                                                FROM `TAVERNE`
                                                LEFT JOIN `GROUPE` ON `TAVERNE`.`t_id`= `GROUPE`.`g_taverne_fk`
                                                LEFT JOIN `NAIN` ON `GROUPE`.`g_id` = `NAIN`.`n_groupe_fk`
                                                LEFT JOIN `VILLE` ON `TAVERNE`.`t_ville_fk`= `VILLE`.`v_id`
                                                WHERE `TAVERNE`.`t_id` =:id
                                                GROUP BY `TAVERNE`.`t_id`
                                                ')) !==false) {
            if($this->_requete->bindValue('id', $id)){
                if($this->_requete->execute()) {
                    if(($data = $this->_requete->fetch(PDO::FETCH_ASSOC))!==false) {
                        $taverne = new Taverne($data);
                        return $taverne ;
                    } 
                } 
            } return false;
        }   
    } catch (PDOException $e) {
        throw new Exception($e->getMessage(),$e->getCode(),$e);
        }
}
public function ReadByVille($id) {
    try {
        if(($this->_requete = $this->_db->prepare('SELECT `TAVERNE`.*, CONCAT(`t_blonde`, " ",`t_brune`, " ",`t_rousse`) AS `t_bieres`
                                                FROM `TAVERNE`
                                                WHERE `t_ville_fk`=:id
                                                ')) !==false) {
        if($this->_requete->bindValue('id', $id)){
            if($this->_requete->execute()) {
                $tavernes = array();
                while( ($data = $this->_requete->fetch(PDO::FETCH_ASSOC) ) !== false ){
                    $tavernes[] =new Taverne($data);
                } return $tavernes;
            }                                            
        }
    }return false;  
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