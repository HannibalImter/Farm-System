<?php 

class User{

    protected $username;
    protected $Password;
    protected $db;

    const user = 0 ;
    const admin = 1;


    public function __construct($pUsername)
    {
        $this->db= new Database();
        $this->username=$pUsername;
    }

      
    public function isDuplicateUsername(){
            
        $sql = "SELECT count(id) AS num FROM users WHERE username = :userName";
        
        $values = array(
            array(':userName', $this->username)
        );
    
        $result = $this->db->queryDB($sql, Database::SELECTSINGLE, $values);

        if ($result['num'] == 0)
            return false;
        else
            return true;            
        
    }

    public function isValidLogin($pPassword){
        $sql = "SELECT * FROM users WHERE username = :username AND deleted_at IS NULL";
        // code befor fixing: $sql was:-> deleted_at = :null";
        $values = array(
            array(':username', $this->username),
            // array(':null', "")
        );

        $result = $this->db->queryDB($sql, Database::SELECTSINGLE, $values);

        if (isset($result['password']) && $result['password'] == $pPassword)
            return $result;
        else
            return false;

    }
   
}