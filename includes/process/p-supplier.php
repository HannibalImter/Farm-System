<?php
include_once "../classes/Supplier.php";


if (isset($_POST['addForm'])) {
    $name = $_POST['sName'];
    $phone = $_POST['phone'];
    $s1 = new Supplier($name, $phone);
    $s1->insertNewSupplier();
    header("Location: ../../supplier_form.php");
    //TODO: add validation. isset($_POST['sName']), isset($_POST['phone'])
} elseif (isset($_POST['deleteForm'])) {
    echo "Delete A Supplier";


    header("Location: ../../supplier_form.php");

}else {
    echo "Wrong Form Or Wrong data selected.";
}



