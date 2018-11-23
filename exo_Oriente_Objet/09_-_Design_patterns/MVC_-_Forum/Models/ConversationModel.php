<?php 
/**
 * class conversationModel --> CRUD
 */
class ConversationModel extends CoreModel {

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
  *                                       READ 
  ****************************************************************************************************/

    public function ReadAll(){
        try {
            if( ($this->_requete = $this->_db->query(' SELECT `c_id` AS `id`,DATE_FORMAT(`c_date`, "%d-%m-%Y %T") AS `date` ,  `c_termine`AS `termine` , COUNT( DISTINCT `m_id`) AS numbers
                                                FROM`conversation`
                                                LEFT JOIN `message` ON `m_conversation_fk` = `c_id`
                                                GROUP BY `c_id`
                                                ')) !== false )  {
                while( ($reponse = $this->_requete->fetch(PDO::FETCH_ASSOC) ) !== false ){

                $conversations[] =new Conversation($reponse);
                // var_dump($reponse);

                }
                return $conversations;
            }
            return false;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(),$e->getCode(),$e);
        } 
    }

}