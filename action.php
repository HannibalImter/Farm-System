<?php
    include "UI_include.php";
    include INC_DIR."/process/p-login.php";
    include INC_DIR.'header2.html';
    include_once 'includes/classes/Action.php';
?>

<body>

    <div class="container my-5">
        <h2>List Of Actions</h2>
        <a href="includes/process/p-action/p-add.php" class="btn btn-primary" role="button">New Action</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Action ID</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $action = new Action();
                $result = $action->getAllActions();
                if (!$result) {
                    die("not found!");
                }
                foreach ($result as $key => $value) {
                    echo "
                        <tr>
                        <td>$value[id]</td>
                        <td>$value[type]</td>
                        <td>$value[description]</td>
                        <td>$value[created_at]</td>
                        <td>
                            <a class='btn btn-primary btn-sm'
                             href='includes/process/p-action/p-edit.php?id=$value[id]'>Edit</a>
                            <a class='btn btn-danger btn-sm'
                              href='includes/process/p-action/p-delete.php?id=$value[id]'>Delete</a>
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