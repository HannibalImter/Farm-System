<?php

$h = new Helper();
$msg = '';
$username = '';

if (isset($_POST['submit']))
{       

    if ($h->isEmpty(array($_POST['username'], $_POST['password'],$_POST['confirm_password'], $_POST['adminPassowrd'])))
    {
        $msg = 'All fields are required';     
    }
//     else if (!$h->isValidLength($username, 6, 100)){
//        $msg = 'Username must be between 6 and 100 characters';
//     }
//    else if (!$h->isValidLength($_POST['password'])){
//        $msg = 'Password must be between 8 and 20 characters';
//     }
//    else if (!$h->isSecure($_POST['password'])){
//        $msg = 'Password must contain at least one lowercase character, one uppercase character and one digit';
//     }
//     else if (!$h->passwordsMatch($_POST['password'], $_POST['confirm_password'])){
//         $msg = 'Passwords do not match';
//     }        
    else
    {

        $user = new user($_POST['username']);

        if ($user->isDuplicateUsername())
        {
            $msg = "username is already in use";
        }
        else
        {
            $user->insertIntoUsers($_POST['password']);
            
            header("Location: login.php?new=1");                
        }
    }
        
}