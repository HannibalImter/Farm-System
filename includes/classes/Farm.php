<?php

class Farm
{
    protected $name;
    protected $city;
    protected $address;
    protected $db;

    public function __construct( $pName, $pCity, $pAddress)
    {
        $this->db=new Database();
        $this->name=$pName;
        $this->city=$pCity;
        $this->address=$pAddress;
    }

    public function setFarm()
    {
        $sql="INSERT INTO farm_info (name,city, address,deleted_at) VALUES (:name,:city,:address,:deleted_at)";

        $values = array(
            array(':name', $this->name),
            array(':city', $this->city),
            array(':address', $this->address),
            array(':deleted_at',"" )
        );

        $this->db->queryDB($sql, Database::EXECUTE, $values);
    
    }
    
}

?>