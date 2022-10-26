<?php
include_once "../classes/Supplier.php";

if (isset($_POST['addForm'])) {
    $name = $_POST['sName'];
    $phone = $_POST['phone'];
    $s1 = new Supplier($name, $phone);
    $s1->insertNewSupplier();
    header("Location: ../../supplier_form.php");
} elseif (isset($_POST['deleteForm'])) {
    $id = $_POST['sIDs'];
    $s1 = new Supplier($id);
    $s1->deleteSupplier();
    header("Location: ../../supplier_form.php");
}else {
    echo "Wrong Form Or Wrong data selected.";
}