<?php

    session_start();
    include "UI_include.php";
    // include INC_DIR."/process/p-home.php";
    include INC_DIR.'header2.html';
    
?>

    <header class="header">
                <h1 class="logo"><a href="#">My Farm Mangment system</a></h1>
                <ul class="main-nav">
                    <li><a href="/Farm-System/home.php">Home</a></li>
                    <li><a href="/Farm-System/settings.php">Settings</a></li>
                    <li><a href="/Farm-System/login.php">LogOut</a></li>
                </ul>
    </header> 

    <body>
    
    <div class="form">   

    <div class = "new">
        <?php
        
            if (isset($_GET['new']))
            echo '<script>alert("User Added Seccussfully!")</script>';

            if (isset($_GET['deleted']))
            echo '<script>alert("User has been deleted!")</script>';
            ?>
    </div>

        <div class="heading">
                <i class="material-icons"></i>
                <h4 class="modal-title">Home Page</h4>
        </div>
      
    </div>

    </body>
</html>                                		                            