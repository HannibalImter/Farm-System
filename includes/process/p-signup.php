<?php

    $h = new Helper();
    $msg = '';
    $username = '';

    if (isset($_POST['submit']))
    {       
        $id= $_POST['ID'];
        $username = $_POST['username'];    
        $farmID = $_POST['farmID'];  

        if ($h->isEmpty(array($_POST['ID'],$_POST['username'], $_POST['password'], $_POST['farmID'], $_POST['confirm_password'])))
        {
            $msg = 'All fields are required';     
        }
        //else if (!$h->isValidLength($username, 6, 100)){
          //  $msg = 'Username must be between 6 and 100 characters';
        //}
      //  else if (!$h->isValidLength($_POST['password'])){
        //    $msg = 'Password must be between 8 and 20 characters';
        //}
      //  else if (!$h->isSecure($_POST['password'])){
        //    $msg = 'Password must contain at least one lowercase character, one uppercase character and one digit';
        //}
        else if (!$h->passwordsMatch($_POST['password'], $_POST['confirm_password'])){
            $msg = 'Passwords do not match';
        }        
        else
        {

            $admin = new Admin($username,$farmID);

            if ($admin->isDuplicateUsername())
            {
                $msg = "username is already in use";
            }
            else
            {
                $admin->insertIntoUsers($_POST['password']);
                header("Location: index.php?new=1");           
            }
                
        }
            
    }