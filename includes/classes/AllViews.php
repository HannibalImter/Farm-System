<?php
include_once 'Database.php';
/* How To use This Class

*/
class AllViews
{
    // private $id;
    // private $name;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getSuplliersView()
    {
        $sql = "SELECT * FROM suplliersnameview";
        try {
            return $this->db->queryDB($sql, Database::SELECTALL);
        } catch (\Throwable $th) {
            echo "An error occurred while trying to get suplliersnameview:"."<br>";
            echo $th->getMessage();
            throw $th;
        }
    }

    public function getSupllierName($id)
    {
        $sql = "SELECT name FROM suplliersnameview WHERE id = :id;";
        $values = array(
            array(':id', $id)
        );
        try {
            return $this->db->queryDB($sql, Database::SELECTSINGLE, $values)['name'];
        } catch (\Throwable $th) {
            echo "An error occurred while trying to get supplier name:"."<br>";
            echo $th->getMessage();
            throw $th;
        }
    }

    public function getCategoriesView()
    {
        $sql = "SELECT * FROM categoriesview";
        try {
            return $this->db->queryDB($sql, Database::SELECTALL);
        } catch (\Throwable $th) {
            echo "An error occurred while trying to get categoriesview:"."<br>";
            echo $th->getMessage();
            throw $th;
        }
    }

    public function getCategoryName($id)
    {
        $sql = "SELECT name FROM categoriesview WHERE id = :id;";
        $values = array(
            array(':id', $id)
        );
        try {
            return $this->db->queryDB($sql, Database::SELECTSINGLE, $values)['name'];
        } catch (\Throwable $th) {
            echo "An error occurred while trying to get category name:"."<br>";
            echo $th->getMessage();
            throw $th;
        }
    }

    

}
