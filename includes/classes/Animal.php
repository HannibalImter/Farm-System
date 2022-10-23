<?php
include_once 'Database.php';
/* How To use This Class
#to set animal class values


#To add new animal


#To delete an animal by id


#To delete an animal by state


#To get an animal by id


#To get all animals


#To increase animal quantity



#A method to do a specific query.



*/
class Animal
{
    private $id; //auto
    private $animalCategoriesID;
    private $start_date; //auto
    private $endDate = null;
    private $barnID;
    private $quantity;
    private $state;
    private $supplierID;
    private $price;
    private $cost;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function setValues($animeCatID, $bID, $quan, $supID, $price, $cost, $state='')
    {
        $this->animalCategoriesID = $animeCatID;
        $this->barnID = $bID;
        $this->quantity = $quan;
        $this->supplierID = $supID;
        $this->price = $price;
        $this->cost = $cost;
        $this->state = $state;
    }

    public function insertNewAnimal()
    {
        $sql = "INSERT INTO animals (animal_categories_id, barn_id,
         quantity, state, supplier_id , price, cost) VALUES
          (:aCID, :bID, :quan, :state, :supID, :price, :cost)";

        $values = array(
            array(':aCID', $this->animalCategoriesID),
            array(':bID', $this->barnID),
            array(':quan', $this->quantity),
            array(':state', $this->state),
            array(':supID', $this->supplierID),
            array(':price', $this->price),
            array(':cost', $this->cost)
        );

        try {
            $this->db->queryDB($sql, Database::EXECUTE, $values);
            return true;
        } catch (\Throwable $th) {
            echo "An error occurred while trying to insert a new Animal \n";
            throw $th;
        }
    }

    public function deleteAnimal($id = -1)
    {
        $sql = "UPDATE animals SET deleted_at = NOW() WHERE id = $id";
        try {
            $this->db->queryDB($sql, Database::EXECUTE);
            return true;
        } catch (\Throwable $th) {
            echo "An error occurred while trying to delete the Animal: \n";
            throw $th;
        }
    }

    public function deleteSupplierByState($state = '')
    {
        $sql = "UPDATE animals SET deleted_at = NOW() WHERE state = :state";
        $values = array(
            array(':state', $state)
        );
        try {
            $this->db->queryDB($sql, Database::EXECUTE, $values);
            return true;
        } catch (\Throwable $th) {
            echo "An error occurred while trying to delete the Animal: \n";
            throw $th;
        }
    }

    public function getAllAnimals()
    {
        $sql = "SELECT * FROM animals WHERE deleted_at is NULL";
        try {
            return $this->db->queryDB($sql, Database::SELECTALL);
        } catch (\Throwable $th) {
            echo "An error occurred while trying to get all animals: \n";
            throw $th;
        }
    }

    public function getAnimal($id = -1)
    {
        $sql = "SELECT * FROM animals WHERE id = $id AND deleted_at is NULL";
        try {
            return $this->db->queryDB($sql, Database::SELECTSINGLE);
        } catch (\Throwable $th) {
            echo "An error occurred while trying to get the Animal: \n";
            throw $th;
        }
    }

    public function doQuery($sql, $mode, $valuesToBind = array())
    {
        //A function to do a specific  query.
        try {
            return $this->db->queryDB($sql, $mode, $valuesToBind);
        } catch (\Throwable $th) {
            echo "An error occurred while trying to go execute the query: \n";
            throw $th;
        }
    }

    public function increaseQuantity($animalID = -1, $increaseBy = 1)
    {
        $sql = "UPDATE animals SET quantity = quantity + $increaseBy WHERE id = $animalID AND deleted_at is NULL";
        try {
            $this->db->queryDB($sql, Database::EXECUTE);
            return true;
        } catch (\Throwable $th) {
            echo "An error occurred while trying to increase the animal quantity \n";
            throw $th;
        }
    }



}
