<?php
include "../../../UI_include.php";
include_once INC_DIR.'/classes/Action.php';

$id = -1;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['id'])) {
        die('No id provided, exiting...');
        exit;
    }
    
    $id = $_GET['id'];
    $a = new Action();
    $a->deleteAction($id);
    header("location: ../../../action.php");
    exit;
}