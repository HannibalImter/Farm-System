<?php
/*
this index file to testing classes.
*/
include_once 'includes/classes/Supplier.php';
include_once 'includes/classes/Animal.php';

function testlog($data)
{ //debuging tool, just ignore it.
    if (is_array($data))
        $data = implode(', ', $data);
    echo "<script>console.log('Log-Out: " . $data . "' );</script>";
}
echo "<h1>Hello World!</h1>";
// ---------------------------------------------------------------------------------


$s1 = new Supplier();

// $result = $s1->insertNewSupplier();
// , 'sup-updated', '1231231230'
$result = $s1->getSupplier(49);

if (is_null($result)) {
    echo "is't null";
} else {
    echo "it's not null";
}

echo "<pre>";
print_r($result);
echo "</pre>";

