<?php
include_once 'Database.php';
/* How To use This Class
#To add new barn
$s1 = new Barn('Name', 'workersNumber as number');
$s1->insertNewBarn();

#To delete a barn by id
$s1 = new Barn(id);
$s1->deleteBarn();

#To get a barn by id
$s1 = new Barn();
$barn = $s1->getBarn(id);

#To get all barn
$s1 = new Barn();
$barn = $s1->getAllBarns();

#A method to do a specific query.
$s1 = new Barn();
$s1->doQuery($sqlQuery, $mode, $valuesToBindArray);

*/

class Barn
{
    private $name;
    private $workersNumber;
    private $id;
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function setValues($name, $workersNumber)
    {
        $this->name = $name;
        $this->workersNumber = $workersNumber;
    }

    public function insertNewBarn()
    {
        $sql = "INSERT INTO barn (name, workers_number) VALUES (:name, :workers_number)";
        $values = array(
            array(':name', $this->name),
            array(':workers_number', $this->workersNumber)
        );
        try {
            $this->db->queryDB($sql, Database::EXECUTE, $values);
        } catch (\Throwable $th) {
            echo 'An error occurred while trying to insert a new barn';
            throw $th;
        }
    }

    public function deleteBarn($id = -1)
    {
        $sql = "UPDATE barn SET deleted_at = NOW() WHERE id = :id";
        $values = array(
             array(':id', $id)
        );
        try {
            $this->db->queryDB($sql, Database::EXECUTE, $values);
        } catch (\Throwable $th) {
            echo 'An error occurred while trying to delete a barn';
            throw $th;
        }
    }


    private function executeQuery($sqlString, $varArray, $errorMsg)
    {
        try {
            return $this->db->queryDB($sqlString, Database::EXECUTE, $varArray);
        } catch (\Throwable $th) {
            echo "$errorMsg"."<br>";
            echo $th->getMessage();
            throw $th;
        }
    }

    public function getBarn($id = -1)
    {
        $sql = "SELECT * FROM barn WHERE id = $id AND deleted_at is NULL";
        return $this->db->queryDB($sql, Database::SELECTSINGLE);
    }

    public function getAllBarns()
    {
        $sql = "SELECT * FROM barn WHERE deleted_at is NULL";
        return $this->db->queryDB($sql, Database::SELECTALL);
    }

    public function updateBarn($id=-1)
    {
        $sql = "UPDATE barn SET name = :name, workers_number = :workers_number WHERE id = :id";
        $values = array(
            array(':id', $id),
            array(':name', $this->name),
            array(':workers_number', $this->workersNumber)
        );
        $this->executeQuery($sql, $values, "An error occurred while trying to update a barn");
    }

    public function doQuery($sql, $mode, $valuesToBind = array())
    {
        //A function to do a specific  query.
        try {
            return $this->db->queryDB($sql, $mode, $valuesToBind);
        } catch (\Throwable $th) {
            echo 'An error occurred while trying to delete a barn';
            throw $th;
        }
    }


}
