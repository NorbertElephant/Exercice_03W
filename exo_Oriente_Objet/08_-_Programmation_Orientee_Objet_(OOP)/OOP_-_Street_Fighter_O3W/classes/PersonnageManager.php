<?php 

/**
 * ------------------------------------------------------------
 * 
 * ------------------------------------------------------------
**/

Class PersonnageManager extends CoreManager {
    /**
     * --------------------------------------------------
     * CONSTANTS
     * --------------------------------------------------
    **/
    const TABLE = 'Personnage';
    const HP = 100;

    /**
     * --------------------------------------------------
     * ATTRIBUTS
     * --------------------------------------------------
    **/

    private $_requete;

    /**
     * --------------------------------------------------
     * MAGIC METHODS
     * --------------------------------------------------
    **/
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


    /**
     * --------------------------------------------------
     * CREATE
     * --------------------------------------------------
    **/
    
    public function AddPersonnage ($name) {
        try{
            if ( ($this->_requete = $this->_db->prepare('INSERT INTO `'.SELF::TABLE.'` (`PER_name`, `PER_hp`) VALUES (:name, '.SELF::HP.')
                ')) !== false ) {    
                if( $this->_requete->bindValue('name', $name) ) {
                    if($this->_requete->execute()) {
                        
                        return '<br> <div class="alert alert-success"> Votre personnage a bien été crée </div>';
                    } 
                } return false;
            }    

        } catch(PDOException $e){
            throw new Exception($e->getMessage(), 99, $e);
        }
    }

     /**
     * --------------------------------------------------
     * READ
     * --------------------------------------------------
    **/

    public function Is_exist($name) {
        try{
            if ( ($this->_requete = $this->_db->prepare('SELECT * FROM `PERSONNAGE` WHERE `PER_name`=:name
                ')) !== false ) {    
                if( $this->_requete->bindValue('name', $name) ) {
                    if($this->_requete->execute()) {
                        if( ($reponse = $this->_requete->fetch(PDO::FETCH_ASSOC) ) !== false ) {
                            return true;
                        }
                    } return false;
                 } 
            } 
        } catch(PDOException $e){
            throw new Exception($e->getMessage(), 99, $e);
        }

    }

    public function ReadAll() {
        try{
            if ( ($this->_requete = $this->_db->query('SELECT * FROM `PERSONNAGE`
                ')) !== false ) {    
                $personnages = array();
                while( ($reponse = $this->_requete->fetch(PDO::FETCH_ASSOC) ) !== false ){

                    $personnages[] =new Personnage($reponse);
                    // var_dump($reponse);
                } 
                return $personnages;
            }    

        } catch(PDOException $e){
            throw new Exception($e->getMessage(), 99, $e);
        }
    }

    public function ShowTr($Listing_personnage) {
        foreach ($Listing_personnage as $value) {
            echo '<tr>';
            echo '<td>  <label class="au-radio">
                            <input type="radio" value="'.$value->get_id().'" id=1 name="combattant">
                            <span class="au-checkmark"></span>
                        </label> </td>';
            echo '<td>'.$value->get_name().'</td>';
            echo '<td>'.$value->get_hp().'</td>';
            echo '</tr>';
        }
    }

    public function ShowOpt($Listing_personnage, $id_personnage, $id_defenseur = 1 ) {

        foreach ($Listing_personnage as $value) {
           if($value->get_id() !== $id_personnage) {
               if ($value->get_id() == $id_defenseur) {
                    echo '<option value='.$value->get_id().' selected="selected"> '.$value->get_name().'</option>'; 
               }else {
                echo '<option value='.$value->get_id().'> '.$value->get_name().'</option>'; 
               }
               
           }
        }
    }

    public function SelectPersonnage($id) {
        try{
            if ( ($this->_requete = $this->_db->prepare('SELECT * FROM `PERSONNAGE` WHERE `PER_id`=:id
                ')) !== false ) {    
                if( $this->_requete->bindValue('id', $id) ) {
                    if($this->_requete->execute()) {
                        if( ($reponse = $this->_requete->fetch(PDO::FETCH_ASSOC) )  !== false ){
                        
                            return new Personnage($reponse);
                        }
                    } 
                } return false;
            }    

        } catch(PDOException $e){
            throw new Exception($e->getMessage(), 99, $e);
        }
    }


     /**
     * --------------------------------------------------
     * UPDATE
     * --------------------------------------------------
    **/
    public function UpdateHp($personnage) {
        try{
            if ( ($this->_requete = $this->_db->prepare('UPDATE `PERSONNAGE` SET `PER_hp`=:hp WHERE `PER_id`=:id 
                ')) !== false ) {
                    if( $this->_requete->bindValue('id', $personnage->get_id()) &&
                    $this->_requete->bindValue('hp', $personnage->get_hp())  ) {
                        if($this->_requete->execute()) {   
                        
                         return true;
                        }
                    }
            } return false;

        } catch(PDOException $e){
            throw new Exception($e->getMessage(), 99, $e);
        }
    }
    

    /**
     * --------------------------------------------------
     * DELETE
     * --------------------------------------------------
    **/
    public function Unset($personnage) {
        try{
            if ( ($this->_requete = $this->_db->prepare('DELETE FROM `PERSONNAGE` WHERE `PER_id`=:id 
                ')) !== false ) {    
                 if( $this->_requete->bindValue('id', $personnage->get_id()) ) {
                     if($this->_requete->execute()) {   
                     
                      return true;
                     }
                 }
         } return false;

        } catch(PDOException $e){
            throw new Exception($e->getMessage(), 99, $e);
        }
        
    }




   




}