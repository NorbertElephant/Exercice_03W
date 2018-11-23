<?php 
/**
 * class conversationModel --> CRUD
 */
class conversationModel {
/***************************************************************************************************
  *                                       ATTRIBUTS
  ****************************************************************************************************/ 
  
    /** Login / mdp pour connection a la BDD 
     * @var string $_db
     */
    Private $_db; 

    /** Login / mdp pour connection a la BDD 
     * @var string $_db
     */
    Private $_requete; 


   /*****************************************************************************************************
  *                                       MAGIC
  ****************************************************************************************************/
    public function __construct(){
        /** DSN : Data Source Name */
        $dsn="mysql:host=127.0.0.1;
        dbname=popo;
        charset=utf8mb4;";
        /**  nom de l'user de la BDD  */
        $user_name="root";
        /** Mdp du l'user pour la BDD */
        $user_psw=""; 
        try{
            $this->_db= new PDO($dsn,$user_name,$user_psw,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(),$e->getCode(),$e);
        }   
    }


    public function __destruct(){
        if(!empty($this->_requete)){
            $this->_requete->closecursor();
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

                $conversations[] =new conversation($reponse);
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