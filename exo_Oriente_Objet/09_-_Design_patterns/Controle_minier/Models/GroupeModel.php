<?php 

class GroupeModel extends coreModel {
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
            if(($this->_requete = $this->_db->query('SELECT `GROUPE`.*,`t_nom`AS `g_nom_taverne`, COUNT(n_id) AS `n_nbreNains` 
                                                     FROM `GROUPE`
                                                     LEFT JOIN `TAVERNE` ON `g_taverne_fk`= `t_id`
                                                     LEFT JOIN `NAIN` ON `n_groupe_fk`= `g_id`
                                                     GROUP BY `g_id`
                                                    ')) !==false) {
                $groupes = array();

                    while( ($data = $this->_requete->fetch(PDO::FETCH_ASSOC) ) !== false ){
                        
                    $groupes[] =new Groupe($data);

                    } return $groupes;
                } return false ;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(),$e->getCode(),$e);
            }
    }
    public function ReadOne($id) {
        try {
                if(($this->_requete = $this->_db->prepare(' SELECT  `GROUPE`.*,`t_nom`AS `g_nom_taverne`, COUNT(n_id) AS `n_nbreNains`  
                                                        FROM `GROUPE`
                                                        LEFT JOIN `TAVERNE` ON `g_taverne_fk`= `t_id`
                                                        LEFT JOIN `NAIN` ON `n_groupe_fk`= `g_id`
                                                        WHERE `g_id`=:id
                                                        GROUP BY `g_id`
                                                        ')) !==false) {
                    if($this->_requete->bindValue('id', $id)){
                        if($this->_requete->execute()) {
                            if(($data = $this->_requete->fetch(PDO::FETCH_ASSOC))!==false) {
                                $groupe = new Groupe($data);
                                return $groupe ;
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