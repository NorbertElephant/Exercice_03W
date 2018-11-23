<?php 
/**
 * class messageModel --> CRUD
 */
class MessageModel extends CoreModel {

   /*****************************************************************************************************
  *                                       MAGIC
  ****************************************************************************************************/
    public function __construct($instance){
        try {
            parent::__construct( $instance );
        } catch( PDOException $e ) {
            throw new CoreException( $e->getMessage() );
        } 
    }


/***************************************************************************************************
  *                                       CREATE 
  ****************************************************************************************************/
    public function CreateMessage($contenu, $date, $auteur ,$conversation) {
        try {
            if( ($this->_requete = $this->_db->prepare(' INSERT INTO `MESSAGE` (`m_contenu`, `m_date`, `m_auteur_fk`, `m_conversation_fk`) VALUES (:contenu, :date, :auteur, :conversation)
                                                ')) !== false )  {
                    if( $this->_requete->bindValue('contenu', $contenu) &&
                        $this->_requete->bindValue('date', $date) &&
                        $this->_requete->bindValue('auteur', $auteur) &&
                        $this->_requete->bindValue('conversation', $conversation) 
                    ) {
                        if($this->_requete->execute()) {
            
                            return '<span style="background-color:#ff0000"> Votre message a bien été crée </span>';
                        } 
                    } return false;
            } 
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(),$e->getCode(),$e);
        }
    }


/***************************************************************************************************
  *                                       READ 
  ****************************************************************************************************/
/**
 * Undocumented function
 *
 * @param [type] $id
 * @param [type] $page
 * @param string $tri
 * @return void
 */
    public function Read($id,$page,$tri = 'date') {
        try {
            $old_page = ($page-1) * 20;
            switch ($tri) {
                case 'id':
                    $tri = 'm_id desc';
                    break;
                case 'nom':
                    $tri = 'nom asc';
                break;
                default:
                $tri = 'm_date desc';
                    break;
            }
            

            if( ($this->_requete = $this->_db->prepare(' SELECT DATE_FORMAT(`m_date`, "%d-%m-%Y %T") AS `date` ,  CONCAT(`u_prenom`," " ,`u_nom`) AS `nom` , `m_contenu` AS `contenu`, (SELECT COUNT( `m_id`) FROM `message` WHERE `m_conversation_fk`=5) AS `numbers`
                                                FROM`message`
                                                RIGHT JOIN `conversation` ON `m_conversation_fk` = `c_id`
                                                RIGHT JOIN `user` ON `m_auteur_fk`=`u_id`
                                                WHERE `m_conversation_fk`=:id
                                                ORDER BY '.$tri.'
                                                LIMIT '.$old_page.', 20
                                                ')) !== false )  {

                    if($this->_requete->bindValue('id', $id, PDO::PARAM_INT)) {
                        if($this->_requete->execute()) {
                            $messages = array();
                            while( ($reponse = $this->_requete->fetch(PDO::FETCH_ASSOC) ) !== false ){

                                $messages[] =new Message($reponse);
                                // var_dump($reponse);
                            } 
                            return $messages;
                        } 
                    }
                }    
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(),$e->getCode(),$e);
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return boolean
     */
    public function is_exist_id($id){
        try{
            if( ($this->_requete = $this->_db->query(' SELECT `c_id` AS `id`
                                                FROM`conversation`
                                                ')) !== false )  {
                 while( ($reponse = $this->_requete->fetch(PDO::FETCH_ASSOC) ) !== false ){

                    if($id == $reponse['id']) {
                        return true;
                    }
                } return false;
        }
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(),$e->getCode(),$e);
        }
    }

}



