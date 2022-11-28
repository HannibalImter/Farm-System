<?php 

class Admin extends User{

    public function __construct($pUsername){
        parent::__construct($pUsername);
    }

    public function insertIntoUsers($pPassword){
            
        $sql = "INSERT INTO users (username,password,isAdmin,deleted_at) VALUES (:username,:password,:isAdmin,:deleted_at)";
        $values = array(
            array(':username', $this->username),
            array(':password', $pPassword),
            array(':isAdmin', Admin::admin),
            array(':deleted_at',"" )
        );

        $this->db->queryDB($sql, Database::EXECUTE, $values);
        
    }

    public function showCurrentUsers()
    {

    }

    public function addUsers()
    {

    }

    public function deleteUseres($pPassword,$deletedUser)
    {
        $result=$this->isValidLogin($pPassword);
        
        if($result!=false)
        {
            $sql="DELETE FROM users WHERE username = :deletedUser";
            $values = array(
                array(':deletedUser', $deletedUser)
            );
            $this->db->queryDB($sql, Database::EXECUTE, $values);
        }
        else{
            echo 'wrong password'; 
        }
        
    }

}


?>