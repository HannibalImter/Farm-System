<?php
include "../../../UI_include.php";
include_once INC_DIR.'/classes/Resource.php';

$id = -1;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['id'])) {
        die('No id provided, exiting...');
        exit;
    }
    
    $id = $_GET['id'];
    $s = new Resource($id);
    $s->deleteResource();
    header("location: ../../../resource.php");
    exit;
}