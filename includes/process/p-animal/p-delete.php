<?php
include "../../../UI_include.php";
include_once INC_DIR.'/classes/Animal.php';
//  ----------------------------------------------------------------

$id = -1;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['id'])) {
        die('No id provided, exiting...');
        exit;
    }
    
    $id = $_GET['id'];
    $s = new Animal();
    $s->deleteAnimal($id);
    header("location: ../../../animal.php");
    exit;
}