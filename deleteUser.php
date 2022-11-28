<?php

    session_start();
    include "UI_include.php";
    include INC_DIR."/process/p-deleteUser.php";
    include INC_DIR.'header3.html';

?>
    
<script src="https://code.iconify.design/iconify-icon/1.0.0/iconify-icon.min.js"></script>
    <body>
        <div class="form">
            <div class="heading">
                <i class="material-icons">create</i>
                <h4 class="modal-title">Delete User </h4>
            </div>
            
            <form action="" method="post" class="form-horizontal">


            <div class="form-group"><i class="material-icons">vpn_key</i>
                    <label class="control-label">Choose User</label>
                    <div>
                        <select  name="deletedPerson" style="width: 100%;">
                            <?php 
                                foreach($names2 as $x)
                                {
                                echo "<option style='text-align: center'  value='$x'>$x</option>";
                                }
                                echo '</select>';
                            ?>
                        </select>
                    </div>        	
            </div>


                <div class="form-group"><i class="material-icons">vpn_key</i>
                    <label class="control-label">Password</label>
                    <div>
                        <input type="password" class="form-control" name="password">
                    </div>        	
                </div>

                <div class="form-group">
                    <div>
                        <center><button type="submit" name = "submit" class="btn btn-primary btn-lg">Delete User</button></center>
                    </div>  
                </div>		      
            </form>
        </div>
    </body>
</html>                            