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

        $arguments = func_get_args();
        $numberOfArguments = func_num_args();
        if ($numberOfArguments == 2) {
            // for insert new barn
            $this->name = $arguments[0]; //$name;
            $this->workersNumber = $arguments[1]; //$Number of workers;
        } elseif ($numberOfArguments == 1) {
            // for delete a barn
            $this->id = $arguments[0]; //$id;
        }
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

    public function deleteBarn()
    {
        $sql = "UPDATE barn SET deleted_at = NOW() WHERE id = :id";
        $values = array(
             array(':id', $this->id)
        );
        try {
            $this->db->queryDB($sql, Database::EXECUTE, $values);
        } catch (\Throwable $th) {
            echo 'An error occurred while trying to delete a barn';
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
