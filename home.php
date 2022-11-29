<?php

    session_start();
    include "UI_include.php";
    // include INC_DIR."/process/p-home.php";
    include INC_DIR.'header2.html';
    
?>
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