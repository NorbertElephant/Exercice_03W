<?php 

class NainModel extends coreModel {
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
        if(($this->_requete = $this->_db->query('SELECT `NAIN`.*,`v_nom`AS `n_nom_ville`
                                                FROM `NAIN`
                                                LEFT JOIN `VILLE` ON `n_ville_fk`= `v_id`
                                                LEFT JOIN `GROUPE` ON `n_groupe_fk`= `g_id`
                                                ')) !==false) {
            $nains = array();

                while( ($data = $this->_requete->fetch(PDO::FETCH_ASSOC) ) !== false ){
                    
                $nains[] =new Nain($data);

                } return $nains;
            } return false ;
    } catch (PDOException $e) {
        throw new Exception($e->getMessage(),$e->getCode(),$e);
        }
}


public function ReadOne($id) {
    try {
            if(($this->_requete = $this->_db->prepare(' SELECT `NAIN`.*, CONCAT(`g_debuttravail` , " h  à " , `g_fintravail`) AS `n_heure_travail` , `TAVERNE`.`t_nom` AS `n_nom_taverne`, `VILLE`.`v_nom`AS `n_nom_ville`, `TAVERNE`.`t_id` AS `n_id_taverne`, `t_villedepart_fk`, `t_villearrivee_fk`,`v.d`.`v_nom` AS `n_villedepart`, `v.a`.`v_nom` AS `n_villearrivee`
                                                        FROM `NAIN`
                                                        LEFT JOIN `GROUPE` ON `n_groupe_fk`= `g_id`
                                                        LEFT JOIN `TAVERNE` ON `g_taverne_fk`= `t_id`
                                                        LEFT JOIN `VILLE` ON `n_ville_fk`= `v_id`
                                                        JOIN `TUNNEL` ON `t_villedepart_fk` = `v_id`
                                                        LEFT JOIN `VILLE` AS  `v.a`  ON `TUNNEL`.`t_villearrivee_fk`= `v.a`.`v_id`
                                                        LEFT JOIN `VILLE` AS  `v.d`  ON `TUNNEL`.`t_villedepart_fk`= `v.d`.`v_id`
                                                        WHERE `n_id`=:id
                                                    ')) !==false) {
                if($this->_requete->bindValue('id', $id)){
                    if($this->_requete->execute()) {
                        if(($data = $this->_requete->fetch(PDO::FETCH_ASSOC))!==false) {
                            $nain = new Nain($data);
                            return $nain ;
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
            if(($this->_requete = $this->_db->prepare('SELECT `NAIN`.*
                                                    FROM `NAIN`
                                                    WHERE `n_ville_fk`=:id
                                                    ')) !==false) {
            if($this->_requete->bindValue('id', $id)){
                if($this->_requete->execute()) {
                    $nains = array();
                    while( ($data = $this->_requete->fetch(PDO::FETCH_ASSOC) ) !== false ){
                        $nains[] =new Nain($data);
                    } return $nains;
                }                                            
            }
        }return false;  
    } catch (PDOException $e) {
            throw new Exception($e->getMessage(),$e->getCode(),$e);
            }
    }

    public function ReadByGroups($id) {
        try {
            if(($this->_requete = $this->_db->prepare('SELECT `NAIN`.*
                                                    FROM `NAIN`
                                                    WHERE `n_groupe_fk`=:id
                                                    ')) !==false) {
            if($this->_requete->bindValue('id', $id)){
                if($this->_requete->execute()) {
                    $nains = array();
                    while( ($data = $this->_requete->fetch(PDO::FETCH_ASSOC) ) !== false ){
                        $nains[] =new Nain($data);
                    } return $nains;
                }                                            
            }
        }return false;  
    } catch (PDOException $e) {
            throw new Exception($e->getMessage(),$e->getCode(),$e);
            }
    }

    public function ReadOneGroups($id) {
        try {
                if(($this->_requete = $this->_db->prepare('SELECT `NAIN`.*, CONCAT(`g_debuttravail` , " h  à " , `g_fintravail`) AS `n_heure_travail` , `TAVERNE`.`t_nom` AS `n_nom_taverne`, `VILLE`.`v_nom`AS `n_nom_ville`, `TAVERNE`.`t_id` AS `n_id_taverne`, `t_villedepart_fk`, `t_villearrivee_fk`,`v.d`.`v_nom` AS `n_villedepart`, `v.a`.`v_nom` AS `n_villearrivee`
                                                            FROM `NAIN`
                                                            LEFT JOIN `GROUPE` ON `n_groupe_fk`= `g_id`
                                                            LEFT JOIN `TAVERNE` ON `g_taverne_fk`= `t_id`
                                                            LEFT JOIN `VILLE` ON `n_ville_fk`= `v_id`
                                                            JOIN `TUNNEL` ON `t_villedepart_fk` = `v_id`
                                                            LEFT JOIN `VILLE` AS  `v.a`  ON `TUNNEL`.`t_villearrivee_fk`= `v.a`.`v_id`
                                                            LEFT JOIN `VILLE` AS  `v.d`  ON `TUNNEL`.`t_villedepart_fk`= `v.d`.`v_id`
                                                            WHERE `n_groupe_fk`=:id
                                                        ')) !==false) {
                    if($this->_requete->bindValue('id', $id)){
                        if($this->_requete->execute()) {
                            if(($data = $this->_requete->fetch(PDO::FETCH_ASSOC))!==false) {
                                $nain = new Nain($data);
                                return $nain ;
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

/**
     * UpdateNainGroupe
     *
     * @param integer $id................ Id du Nain concerné
     * @param array $data................ Tableau du Formulaire
     * @return void
     */
    public function UpdateNainGroupe (int $id ,array $data) {
        $id = intval($id);
        if ($data['groupe'] == '0') {
            try{
                if( ($this->_requete = $this->_db->prepare('UPDATE `NAIN`  
                                                            SET    `n_groupe_fk` =  NULL 
                                                            WHERE `n_id`=:id
                                                            ')) !== false )  {
                    if($this->_requete->bindValue('id', $id)
                        ) {
                        if($this->_requete->execute()) {
                        return true;
                        } 
                    } return false;
            }
            } catch (PDOException $e) {
                throw new Exception($e->getMessage(),99,$e);
                }
        } else {
            try{
                if( ($this->_requete = $this->_db->prepare(' UPDATE `NAIN`  
                                                             SET    `n_groupe_fk`=:idgroupe 
                                                             WHERE `n_id`=:id
                                                            ')) !== false )  {
                    if($this->_requete->bindValue('id', $id)&& 
                        $this->_requete->bindValue('idgroupe', $data['groupe'])
                        ) {
                        if($this->_requete->execute()) {
                        return true;
                        } 
                    } return false;
            }
            } catch (PDOException $e) {
                throw new Exception($e->getMessage(),99,$e);
                }
        }
      
    }
/***************************************************************************************************
  *                                       DELETE 
****************************************************************************************************/


}