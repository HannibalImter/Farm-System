<?php

$h = new Helper();

$user = new User( $_SESSION['username']);
$names=$user->getUsers( $_SESSION['id']);

$counter = 0;
// echo $names->count();
foreach($names as $x)
{
    $counter +=1; 
}

$names2=array();

for($i=0;$i<$counter;$i++)
{
    array_push($names2,$names[$i]['username']);
}


if(isset($_POST['submit']))
{
    $admin = new Admin($_SESSION['username']);
    $admin->deleteUseres($_POST['password'],$_POST['deletedPerson']);
?>

<script>alert('user Deleted Succefully!')</script>

<?php
    header("location: Home.php?deleted=1");

 
}

