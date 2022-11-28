<?php

use LDAP\Result;

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
        $sql = "SELECT * FROM users WHERE username = :username AND deleted_at = '0000-00-00 00:00:00' ";
        $values = array(
            array(':username', $this->username)
        );
        $result = $this->db->queryDB($sql, Database::SELECTSINGLE, $values);

        if (isset($result['password']) && $result['password'] == $pPassword)
            return $result;
        else
            return false;

    }

    public function insertIntoUsers($pPassword){
            
        $sql = "INSERT INTO users (username,password,isAdmin,deleted_at) VALUES (:username,:password,:isAdmin,:deleted_at)";
        $values = array(
            array(':username', $this->username),
            array(':password', $pPassword),
            array(':isAdmin', User::user),
            array(':deleted_at',"" )
        );

        $this->db->queryDB($sql, Database::EXECUTE, $values);
        
    }
 
    public function getUsers($id){
        $sql= "SELECT username,id,isAdmin from users where id != :id and deleted_at = '0000-00-00 00:00:00' ";
    
        $values = array(
            array(':id', $id)
        );

      $result= $this->db->queryDB($sql,Database::SELECTALL,$values);
      return $result;
    }
    
}