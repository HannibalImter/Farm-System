<?php
/*
this index file to testing classes.
*/
include_once 'includes/classes/Barn.php';

echo "<h1>Hello World!</h1>";

// $s1 = new Supplier();
// $supplier = $s1->getSupplier(23);

// print_r($supplier);

$b1 = new Barn('الحظيرة', 5);
$b1->insertNewBarn();

$barns = $b1->getAllBarns();
print_r($barns);