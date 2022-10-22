<?php

    $h = new Helper();
    $msg = '';
    $username = '';
    $farmName='';
    $farmCity='';
    $farmAddress='';

    if (isset($_POST['submit']))
    {       
        $username = $_POST['username'];    
        $farmName = $_POST['farmName'];  
        $farmCity = $_POST['farmCity'];  
        $farmAddress= $_POST['farmAddress'];  

        if ($h->isEmpty(array($_POST['username'], $_POST['password'],$_POST['confirm_password'], $_POST['farmName'],$_POST['farmCity'],$_POST['farmAddress'])))
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
            $admin = new Admin($username);

            if ($admin->isDuplicateUsername())
            {
                $msg = "username is already in use";
            }
            else
            {
                $admin->insertIntoUsers($_POST['password']);

                $farm = new Farm($farmName,$farmCity,$farmAddress);
                $farm->setFarm();

                header("Location: index.php?new=1");                
            }
        }
            
    }