<?php

    session_start();
    if($_SESSION['id']=="")
    {
        header('/Farm-System/login.php');
    }
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

        
        <form action="" method="get" class="form-horizontal" >
                <div >
                    <center>
                        <button 
                            type="submit" 
                            <?php if($_SESSION['isAdmin'] == 0) echo 'style="display: none;" '?>
                            class="btn btn1 btn-primary btn-lg" 
                            style="width: 200px;" 
                            value="1"
                            name="addUser";
                            >
                            Add Users
                        </button>
                    </center>
                </div>  

                <div >
                    <center><button type="submit" 
                    <?php if($_SESSION['isAdmin'] == 0) echo 'style="display: none;" '?>
                     class="btn btn1 btn-primary btn-lg" style="width: 200px;" name = "deleteUser" >Delete Users</button></center>
                </div>
                
                <div >
                    <center><button type="submit" 
                    <?php if($_SESSION['isAdmin'] == 0) echo 'style="display: none;" '?>
                     class="btn btn1 btn-primary btn-lg" style="width: 200px;" >Edit Farm Name</button></center>
                </div>
                

                <div >
                    <center><button type="submit" class="btn btn1 btn-primary btn-lg" style="width: 200px;" >Change Username</button></center>
                </div>

                <div >
                    <center><button type="submit" class="btn btn1 btn-primary btn-lg" style="width: 200px;" >Change Password</button></center>
                </div>
                
            </div>		              
            </form>

            
         
    </div>
    </body>
</html>                                		                            