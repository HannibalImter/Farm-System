<?php
/*
this index file to testing classes.
*/
include_once 'includes/classes/Supplier.php';
include_once 'includes/classes/Animal.php';

function logout($data)
{ //debuging tool, just ignore it.
    if (is_array($data))
        $data = implode(', ', $data);
    echo "<script>console.log('Log-Out: " . $data . "' );</script>";
}
echo "<h1>Hello World!</h1>";
// ---------------------------------------------------------------------------------


$animal = new Animal();

// $animal->setValues(1, 1, 3, 23, 13.5, 7.25, 'active');
// $animal->insertNewAnimal();

// $animal->deleteSupplierByState('active');
// $animal->increaseQuantity(animalID: 19, increaseBy: 10);

$result = $animal->getAllAnimals();
echo "<pre>";
print_r($result);
echo "</pre>";

