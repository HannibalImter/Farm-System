<?php
   
class Database{

    const SELECTSINGLE = 1;
    const SELECTALL = 2;
    const EXECUTE = 3;
        
    private $pdo;

    public function __construct()
    {
        // mysql:host=localhost;dbname=project", "project_admin", "Your Password
        // mysql:host=localhost;dbname=project", "project_admin", "ABCD
        $this->pdo = new PDO("mysql:host=localhost;dbname=farm", "root", "");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    //Add queryDB() here
    public function queryDB($sql, $mode, $values = array())
    {
        $stmt = $this->pdo->prepare($sql);
        
        foreach ($values as $valueToBind) {
            $stmt->bindValue($valueToBind[0], $valueToBind[1]);
        }
        
        $stmt->execute();

        if ($mode != Database::SELECTSINGLE && $mode != Database::SELECTALL && $mode != Database::EXECUTE){
            throw new Exception('Invalid Mode');
        }elseif ($mode == Database::SELECTSINGLE) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }elseif ($mode == Database::SELECTALL) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
        
    
}
    