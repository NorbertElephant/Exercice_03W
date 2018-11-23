<?php 

class TunnelModel extends coreModel {
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
            if(($this->_requete = $this->_db->query('SELECT `TUNNEL`.*
                                                    FROM `TUNNEL`
                                                    ')) !==false) {
                $tunnels = array();

                    while( ($data = $this->_requete->fetch(PDO::FETCH_ASSOC) ) !== false ){
            
                    $tunnels[] =new Tunnel($data);
                    } return $tunnels;
                } return false ;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(),$e->getCode(),$e);
            }
    }

    public function ReadOne($id) {
        try {
                if(($this->_requete = $this->_db->prepare('SELECT `TUNNEL`.* 
                                                        FROM `TUNNEL`
                                                        ')) !==false) {
                    if($this->_requete->bindValue('id', $id)){
                        if($this->_requete->execute()) {
                            if(($data = $this->_requete->fetch(PDO::FETCH_ASSOC))!==false) {
                                $tunnel = new Tunnel($data);
                                return $tunnel ;
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
                if(($this->_requete = $this->_db->prepare('SELECT `TUNNEL`.*, `v.a`.`v_nom` AS `t_nom_villearrivee`
                                                        FROM `TUNNEL`
                                                        JOIN `VILLE` AS `v.a` ON  `TUNNEL`.`t_villearrivee_fk`= `v_id`
                                                        WHERE `TUNNEL`.`t_villedepart_fk`=:id
                                                        OR `TUNNEL`.`t_villearrivee_fk`=:id
                                                        ')) !==false) {
                    if($this->_requete->bindValue('id', $id)){
                        if($this->_requete->execute()) {
                            $tunnels= array();
                            while(($data = $this->_requete->fetch(PDO::FETCH_ASSOC))!==false) {
                                $tunnels[] = new Tunnel($data);
                                
                            } return $tunnels ;
                        } 
                    } return false;
                }   
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(),$e->getCode(),$e);
            }
    }

    public function ReadByGroup($id) {
        try {
                if(($this->_requete = $this->_db->prepare('SELECT `TUNNEL`.*, `a`.`v_nom` AS `t_nom_villearrivee`, `b`.`v_nom` AS `t_nom_villedepart`
                                                        FROM `TUNNEL`
                                                        JOIN `VILLE`  AS `a` ON  `TUNNEL`.`t_villearrivee_fk`= `a`.`v_id` 
                                                        JOIN `VILLE` AS `b`ON  `TUNNEL`.`t_villedepart_fk`= `b`.`v_id`
                                                        WHERE `TUNNEL`.`t_id`=:id
                                                        ')) !==false) {
                    if($this->_requete->bindValue('id', $id)){
                        if($this->_requete->execute()) {
                            while(($data = $this->_requete->fetch(PDO::FETCH_ASSOC))!==false) {
                                $tunnel = new Tunnel($data);
                                
                            } return $tunnel ;
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