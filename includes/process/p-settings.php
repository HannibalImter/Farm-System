<?php

$h = new Helper();

if(isset( $_GET['addUser']))
{
    header("Location: addUser.php");

}
elseif(isset($_GET['deleteUser']))
{
    header("Location: signup.php");

}