<?php
    // session_start();
    include "UI_include.php";
    include INC_DIR."/process/p-login.php";
    include INC_DIR.'header.html';
?>

<header class="header">
            <h1 class="logo"><a href="#">My Farm Mangment system</a></h1>
            <ul class="main-nav">
            <li><a href="/Farm-website-main/signupadmin.php">SignUp</a></li>
            <li><a href="/Farm-website-main/Login.php">Login</a></li>
        </ul>
</header>
<body>
    <div class="form">
        <div class = "new">
            <?php
            if (isset($_GET['new']))
            echo 'ACCOUNT CREATED SUCCESSFULLY';
            ?>
            </div>
            <div class="heading">
                <em class="material-icons">account_box</em>
                <h4 class="modal-title">Login to Your Account</h4>
            </div>
            <form action="" method="post" class="form-horizontal">
                <div class="form-group top"><em class="material-icons">face</em>
                <label class="control-label">Username</label>
                <div>
                    <input type="text" class="form-control" name="username"
                     <?php $h->keepValues($username, 'textbox'); ?> >
                    </div>
                </div>
                <div class="form-group"><em class="material-icons">vpn_key</em>
                    <label class="control-label">Password</label>
                    <div>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class = "formerror"><?php echo $msg; ?></div>
                <div class="form-group">
                    <div>
                        <center><button type="submit" name = "submit" class="btn btn-primary btn-lg">Log In</button></center>
                    </div>
                </div>
            </form>
            <div class="bottom-text">Don't have an Admin account? <a href="/Farm-website-main/signupAdmin.php">Sign up</a></div>
        </div>
    </body>
</html>