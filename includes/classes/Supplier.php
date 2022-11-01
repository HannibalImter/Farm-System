<?php
include_once 'Database.php';
/* How To use This Class
#To add new supplier
$s1 = new Supplier('Name', 'phone as string');
$s1->insertNewSupplier();

#To delete a supplier by id
$s1 = new Supplier(id);
$s1->deleteSupplier();

#To delete a supplier by phone number
$s1 = new Supplier();
$s1->deleteSupplier("phone number");

#To update a supplier
$s1 = new Supplier();
$s1->updateSupplier($id, $name, $phone);

#To get a supplier by id
$s1 = new Supplier();
$supplier = $s1->getSupplier(id);

#To get all suppliers
$s1 = new Supplier();
$suppliers = $s1->getAllSuppliers();

#A method to do a specific query.
$s1 = new Supplier();
$s1->doQuery($sqlQuery, $mode, $valuesToBindArray);

*/

class Supplier
{
    private $name;
    private $phone;
    private $id;
    private $db;

    public function __construct()
    {
        $this->db = new Database();

        $arguments = func_get_args();
        $numberOfArguments = func_num_args();
        if ($numberOfArguments == 2) {
            // for insert new supplier
            $this->name = $arguments[0]; //$name;
            $this->phone = $arguments[1]; //$phone;
        } elseif ($numberOfArguments == 1) {
            // for delete a supplier
            $this->id = $arguments[0]; //$id;
        }
    }

    public function insertNewSupplier()
    {
        $sql = "INSERT INTO suppliers (name, phone) VALUES (:name, :phone)";
        $values = array(
            array(':name', $this->name),
            array(':phone', $this->phone)
        );
        try {
            $this->db->queryDB($sql, Database::EXECUTE, $values);
        } catch (\Throwable $th) {
            echo 'An error occurred while trying to insert a new supplier';
            throw $th;
        }
    }

    public function deleteSupplier()
    {
        $sql = "UPDATE suppliers SET deleted_at = NOW() WHERE id = :id";
        $values = array(
             array(':id', $this->id)
        );
        try {
            $this->db->queryDB($sql, Database::EXECUTE, $values);
        } catch (\Throwable $th) {
            echo 'An error occurred while trying to delete a supplier';
            throw $th;
        }
    }

    public function deleteSupplierByPhone($deletePhone = '')
    {
        $sql = "UPDATE suppliers SET deleted_at = NOW() WHERE phone = :phone";
        $values = array(
             array(':phone', $deletePhone)
        );
        try {
            $this->db->queryDB($sql, Database::EXECUTE, $values);
        } catch (\Throwable $th) {
            echo 'An error occurred while trying to delete a supplier ';
            throw $th;
        }
    }

    public function updateSupplier($id=-1, $name='', $phone='')
    {
        $sql = "UPDATE suppliers SET name = :name, phone = :phone WHERE id = :id";
        $values = array(
            array(':id', $id),
            array(':name', $name),
            array(':phone', $phone)
        );
        try {
            $this->db->queryDB($sql, Database::EXECUTE, $values);
        } catch (\Throwable $th) {
            echo 'An error occurred while trying to update a supplier';
            echo $th->getMessage();
            throw $th;
        }
    }

    public function getSupplier($id = -1)
    {
        $sql = "SELECT * FROM suppliers WHERE id = $id AND deleted_at is NULL";
        return $this->db->queryDB($sql, Database::SELECTSINGLE);
    }

    public function getAllSuppliers()
    {
        $sql = "SELECT * FROM suppliers WHERE deleted_at is NULL";
        return $this->db->queryDB($sql, Database::SELECTALL);
    }

    public function doQuery($sql, $mode, $valuesToBind = array())
    {
        //A function to do a specific  query.
        try {
            return $this->db->queryDB($sql, $mode, $valuesToBind);
        } catch (\Throwable $th) {
            echo 'An error occurred while trying to delete a supplier';
            throw $th;
        }
    }

}
