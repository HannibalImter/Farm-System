<?php

session_start();
$h = new Helper();
$msg = '';
$username = '';


if (isset($_POST['submit']))
{       

    if ($h->isEmpty(array($_POST['username'], $_POST['password'],$_POST['confirm_password'], $_POST['adminPassword'])))
    {
        $msg = 'All fields are required';     
    }
     else if (!$h->passwordsMatch($_POST['password'], $_POST['confirm_password'])){
         $msg = 'Passwords do not match';
        }        
    else
    {

        $user = new user($_POST['username']);

        if ($user->isDuplicateUsername())
        {
            $msg = "username is already in use";
        }
        else
        {
            $admin=new Admin($_SESSION['username']);
            $result=$admin->isValidLogin($_POST['adminPassword']);
            if($result==true)
            {
                $user->insertIntoUsers($_POST['password']);
                header("Location: home.php?new=1");

            }
            else
            {
                $msg = 'Admin password is not correct';
            }
                            
        }
    }
        
}