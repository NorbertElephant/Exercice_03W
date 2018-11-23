<?php 
/**
 *  CRUD pour USer
 */

class userModel extends coreModel {

/***************************************************************************************************
  *                                       CREATE 
  ****************************************************************************************************/
  public function CreateAccount($login, $prenom = '', $nom ='' ,$date_naissance='', $date_inscription ) {
    try {
        if( ($this->_requete = $this->_db->prepare(' INSERT INTO `USER` (`u_login`, `u_prenom`, `u_nom`, `u_date_naissance`, `u_date_inscription`, `u_rang_fk`) VALUES (:login, :prenom, :nom,:date_naissance, :date_inscription,3)
                                            ')) !== false )  {
                if( $this->_requete->bindValue('login', $login) &&
                    $this->_requete->bindValue('prenom', $prenom) &&
                    $this->_requete->bindValue('nom', $nom) &&
                    $this->_requete->bindValue('date_naissance', $date_naissance) && 
                    $this->_requete->bindValue('date_inscription', $date_inscription)    
                ) {
                    if($this->_requete->execute()) {
        
                        return 'Votre compte a bien été crée';
                    } 
                } 
        } 
    } catch (PDOException $e) {
        throw new Exception($e->getMessage(),$e->getCode(),$e);
    }
}


/***************************************************************************************************
  *                                       READ 
****************************************************************************************************/

    public function connect($login) {
        try{
            if( ($this->_requete = $this->_db->prepare(' SELECT `u_login` AS `login`, `u_id` AS `id`, `u_prenom` AS `prenom`, `u_nom` AS `nom`, `u_date_naissance` AS `date_naissance`, `u_date_inscription` AS `date_inscription`, `u_rang_fk` AS `rang`
                                                FROM `user`
                                                WHERE `u_login`=:login
                                                ')) !== false )  {
                 if($this->_requete->bindValue('login', $login)) {
                    if($this->_requete->execute()) {
                        if(($data = $this->_requete->fetch(PDO::FETCH_ASSOC))!==false) {
                            return new user($data);
                        }
                    }  
                } return false;
        } 
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(),$e->getCode(),$e);
            }
   }


}