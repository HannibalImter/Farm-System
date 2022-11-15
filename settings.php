<?php

    session_start();
    include "UI_include.php";
    include INC_DIR."/process/p-settings.php";
    include INC_DIR.'header2.html';

?>



    <body>
    <div class="form">   

    <div class="heading">
            <i class="material-icons">settings</i>
            <h4 class="modal-title">settings</h4>
        </div>

      
        <form action="" method="post" class="form-horizontal">

                <div >
                    <center><button type="submit" 
                    <?php if($_SESSION['isAdmin'] == 0) echo 'style="display: none;" '?>
                     class="btn btn-primary btn-lg" style="width: 200px;" >Add Users</button></center>
                </div>  

                <div >
                    <center><button type="submit" 
                    <?php if($_SESSION['isAdmin'] == 0) echo 'style="display: none;" '?>
                     class="btn btn-primary btn-lg" style="width: 200px;" >Delete Users</button></center>
                </div>
                
                <div >
                    <center><button type="submit" 
                    <?php if($_SESSION['isAdmin'] == 0) echo 'style="display: none;" '?>
                     class="btn btn-primary btn-lg" style="width: 200px;" >Edit Farm Name</button></center>
                </div>
                

                <div >
                    <center><button type="submit" class="btn btn-primary btn-lg" style="width: 200px;" >Change Username</button></center>
                </div>

                <div >
                    <center><button type="submit" class="btn btn-primary btn-lg" style="width: 200px;" >Change Password</button></center>
                </div>
                
            </div>		              
        </form>			


    </div>
    </body>
</html>                                		                            