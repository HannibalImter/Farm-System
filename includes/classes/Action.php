<?php
include_once 'Database.php';
/* How To use This Class
#To add new actions
$s1 = new Action('Name', 'description as number');
$s1->insertNewBarn();

#To delete a actions by id
$s1 = new Action(id);
$s1->deleteBarn();

#To get a actions by id
$s1 = new Action();
$actions = $s1->getBarn(id);

#To get all actions
$s1 = new Action();
$actions = $s1->getAllBarns();

#A method to do a specific query.
$s1 = new Action();
$s1->doQuery($sqlQuery, $mode, $valuesToBindArray);

*/

class Action
{
    private $id;
    private $type;
    private $description;
    private $user_id;
    private $created_at;
    private $animal_id;
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function setValues($type, $description)
    {
        $this->type = $type;
        $this->description = $description;
    }


    public function insertNewAction()
    {
        $sql = "INSERT INTO actions (type, description, created_at) VALUES (:type, :description, NOW())";
        $values = array(
            array(':type', $this->type),
            array(':description', $this->description),
        );
        try {
            $this->db->queryDB($sql, Database::EXECUTE, $values);
        } catch (\Throwable $th) {
            echo 'An error occurred while trying to insert a new actions';
            throw $th;
        }
    }

    public function deleteAction($id = -1)
    {
        $sql = "UPDATE actions SET deleted_at = NOW() WHERE id = :id";
        $values = array(
             array(':id', $id)
        );
        try {
            $this->db->queryDB($sql, Database::EXECUTE, $values);
        } catch (\Throwable $th) {
            echo 'An error occurred while trying to delete a actions';
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

    public function getAction($id = -1)
    {
        $sql = "SELECT * FROM actions WHERE id = $id AND deleted_at is NULL";
        return $this->db->queryDB($sql, Database::SELECTSINGLE);
    }

    public function getAllActions()
    {
        $sql = "SELECT * FROM actions WHERE deleted_at is NULL";
        return $this->db->queryDB($sql, Database::SELECTALL);
    }

    public function updateAction($id=-1)
    {
        $sql = "UPDATE actions SET type = :type, description = :description WHERE id = :id";
        $values = array(
            array(':id', $id),
            array(':type', $this->type),
            array(':description', $this->description),
        );
        $this->executeQuery($sql, $values, "An error occurred while trying to update a actions");
    }

    public function doQuery($sql, $mode, $valuesToBind = array())
    {
        //A function to do a specific  query.
        try {
            return $this->db->queryDB($sql, $mode, $valuesToBind);
        } catch (\Throwable $th) {
            echo 'An error occurred while trying to delete a actions';
            throw $th;
        }
    }


}
