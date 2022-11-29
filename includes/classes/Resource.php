<?php
include_once 'Database.php';
/* How To use This Class
#To add new resources
$s1 = new Resource('Name', 'workersNumber as number');
$s1->insertNewBarn();

#To delete a resources by id
$s1 = new Resource(id);
$s1->deleteResources();

#To get a resources by id
$s1 = new Resource();
$resources = $s1->getResources(id);

#To get all resources
$s1 = new Resource();
$resources = $s1->getAllResources();

#A method to do a specific query.
$s1 = new Resource();
$s1->doQuery($sqlQuery, $mode, $valuesToBindArray);

*/

class Resource
{
    private $name;
    private $quantity;
    private $id;
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function setValues($name, $quantity)
    {
        $this->name = $name;
        $this->quantity = $quantity;
    }

    public function insertNewResource()
    {
        $sql = "INSERT INTO resources (name, quantity) VALUES (:name, :quantity)";
        $values = array(
            array(':name', $this->name),
            array(':quantity', $this->quantity)
        );
        try {
            $this->db->queryDB($sql, Database::EXECUTE, $values);
        } catch (\Throwable $th) {
            echo 'An error occurred while trying to insert a new resource';
            throw $th;
        }
    }

    public function deleteResource($id = -1)
    {
        $sql = "UPDATE resources SET deleted_at = NOW() WHERE id = :id";
        $values = array(
             array(':id', $id)
        );
        try {
            $this->db->queryDB($sql, Database::EXECUTE, $values);
        } catch (\Throwable $th) {
            echo 'An error occurred while trying to delete a resource';
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

    public function getResource($id = -1)
    {
        $sql = "SELECT * FROM resources WHERE id = $id AND deleted_at is NULL";
        return $this->db->queryDB($sql, Database::SELECTSINGLE);
    }

    public function getAllResources()
    {
        $sql = "SELECT * FROM resources WHERE deleted_at is NULL";
        return $this->db->queryDB($sql, Database::SELECTALL);
    }

    public function updateResource($id=-1)
    {
        $sql = "UPDATE resources SET name = :name, quantity = :quantity WHERE id = :id";
        $values = array(
            array(':id', $id),
            array(':name', $this->name),
            array(':quantity', $this->quantity)
        );
        $this->executeQuery($sql, $values, "An error occurred while trying to update a resources");
    }

    public function doQuery($sql, $mode, $valuesToBind = array())
    {
        //A function to do a specific  query.
        try {
            return $this->db->queryDB($sql, $mode, $valuesToBind);
        } catch (\Throwable $th) {
            echo 'An error occurred while trying to delete a resources';
            throw $th;
        }
    }


}
