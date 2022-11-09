<?php
include_once 'Database.php';
/* How To use This Class

#To add new animal
animal = new Animal();
animal->setValues(param1, param2, param3...);
animale->insertNewAnimal();

#To delete an animal by id

animale->deleteAnimal($id);

#To get an animal by id
animale->getAnimal($id);

#To get all animals
animale->getAllAnimals();

#To increase animal quantity
animale->increaseQuantity();

#To update an animal
animale->updateAnimal($id);

#To mark cycle as completed
animale->markAsEnd($id);

#A method to do a specific query.
animale->doQuery();
*/
class Animal
{
    private $animalCategoriesID;
    private $barnID;
    private $quantity;
    private $state = '';
    private $supplierID;
    private $price;
    private $cost;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function setValues($animeCatID, $quan, $state, $price, $cost, $bID, $supID)
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
            echo "An error occurred while trying to insert a new Animal."."<br>";
            echo $th->getMessage();
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
            echo "An error occurred while trying to delete the Animal:"."<br>";
            echo $th->getMessage();
            throw $th;
        }
    }

    public function getAllAnimals()
    {
        $sql = "SELECT * FROM animals WHERE deleted_at is NULL";
        try {
            return $this->db->queryDB($sql, Database::SELECTALL);
        } catch (\Throwable $th) {
            echo "An error occurred while trying to get all animals:"."<br>";
            echo $th->getMessage();
            throw $th;
        }
    }

    public function getAnimal($id = -1)
    {
        $sql = "SELECT * FROM animals WHERE id = $id AND deleted_at is NULL";
        try {
            return $this->db->queryDB($sql, Database::SELECTSINGLE);
        } catch (\Throwable $th) {
            echo "An error occurred while trying to get the Animal:"."<br>";
            echo $th->getMessage();
            throw $th;
        }
    }

    public function getAllAnimalsWithJoins()
    {
        // Get all.
    }

    public function updateAnimal($id = -1)
    {
        //TODO: Implement the correct updateAnimal method.
        $sql = "UPDATE animals SET animal_categories_id = :aCID, quantity = :quan, state = :state,
         price = :price, cost = :cost, barn_id = :bID, supplier_id = :supID WHERE id = :id;";
        $values = array(
            array(':id', $id),
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
            if ($this->state == 'Active' || $this->state == 'Inactive') {
                $this->reOpenCycle($id);
            }
            return true;
        } catch (\Throwable $th) {
            echo "An error occurred while trying to update the animal cycle"."<br>";
            echo $th->getMessage();
            throw $th;
        }
    }

    public function markAsEnd($id = -1)
    {
        $sql = "UPDATE animals SET end_date = NOW(), state = 'Done' WHERE id = $id";
        try {
            $this->db->queryDB($sql, Database::EXECUTE);
            return true;
        } catch (\Throwable $th) {
            echo "An error occurred while trying to delete the Animal:"."<br>";
            echo $th->getMessage();
            throw $th;
        }
    }

    private function reOpenCycle($id = -1)
    {
        $sqlDoneRemove = "UPDATE animals SET end_date = NULL WHERE id = :id;";
        try {
            $this->db->queryDB($sqlDoneRemove, Database::EXECUTE, array(array(':id', $id)));
        } catch (\Throwable $th) {
            echo "An error occurred while trying to reopen the cycle"."<br>";
            echo $th->getMessage();
            throw $th;
        }
    }

    public function doQuery($sql, $mode, $valuesToBind = array())
    {
        //A function to do a specific  query.
        try {
            return $this->db->queryDB($sql, $mode, $valuesToBind);
        } catch (\Throwable $th) {
            echo "An error occurred while trying to go execute the query:"."<br>";
            echo $th->getMessage();
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
            echo "An error occurred while trying to increase the animal quantity."."<br>";
            echo $th->getMessage();
            throw $th;
        }
    }

}