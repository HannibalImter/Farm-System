<?php
    include "UI_include.php";
    include INC_DIR."/process/p-login.php";
    include INC_DIR.'header.html';
    include_once 'includes/classes/Barn.php';
?>

<header class="header">
  <h1 class="logo"><a href="#">My Farm Mangment system</a></h1>
  <ul class="main-nav">
  </ul>
</header>
<body>

    <div class="container my-5">
        <h2>List Of Barns</h2>
        <a href="includes/process/p-barn/p-add-barn.php" class="btn btn-primary" role="button">New Barn</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Barn ID</th>
                    <th>Barn Name</th>
                    <th>Workers Number</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $barns = new Barn();
                $result = $barns->getAllBarns();
                if (!$result) {
                    die("not found!");
                }
                foreach ($result as $key => $value) {
                    echo "
                        <tr>
                        <td>$value[id]</td>
                        <td>$value[name]</td>
                        <td>$value[workers_number]</td>
                        <td>
                            <a class='btn btn-primary btn-sm'
                             href='includes/process/p-barn/p-edit.php?id=$value[id]'>Edit</a>
                            <a class='btn btn-danger btn-sm'
                              href='includes/process/p-barn/p-delete.php?id=$value[id]'>Delete</a>
                        </td>
                        </tr>
                    ";
                }

                ?>
                
            </tbody>
        </table>

    </div>


</body>
</html>