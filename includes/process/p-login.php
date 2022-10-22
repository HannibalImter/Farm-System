<?php

    $h = new Helper();
    $msg = '';
    $username = '';

    if (isset($_POST['submit']))
    {        
        $username = $_POST['username'];                

        if ($h->isEmpty(array($username, $_POST['password'])))
        {
            $msg = 'All fields are required';     
        }
        else
        {
            $member = new User($username);

            $result=$member->isValidLogin($_POST['password']);

            if ($result == false)
            {
                $msg = "Invalid Username or Password";
            }
            else
            {

                $_SESSION['username'] = $username;
                $_SESSION['id'] = $result['id'];
                $_SESSION['password'] = $result['password'];//Temproray
                $_SESSION['isAdmin'] = $result['isAdmin'];

                echo $result['isAdmin'];
                echo $_SESSION['isAdmin'];

                header("Location: home.php");                
            }
        }
            
    }