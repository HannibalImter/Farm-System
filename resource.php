<?php
    include "UI_include.php";
    include INC_DIR."/process/p-login.php";
    include INC_DIR.'header2.html';
    include_once 'includes/classes/Resource.php';
?>
<body>

    <div class="container my-5">
        <h2>List Of Resources</h2>
        <a href="includes/process/p-resource/p-add-resource.php" class="btn btn-primary" role="button">New Resource</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Resource ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $resources = new Resource();
                $result = $resources->getAllResources();
                if (!$result) {
                    die();
                }
                foreach ($result as $key => $value) {
                    echo "
                        <tr>
                        <td>$value[id]</td>
                        <td>$value[name]</td>
                        <td>$value[quantity]</td>
                        <td>
                            <a class='btn btn-primary btn-sm'
                             href='includes/process/p-resource/p-edit.php?id=$value[id]'>Edit</a>
                            <a class='btn btn-danger btn-sm'
                              href='includes/process/p-resource/p-delete.php?id=$value[id]'>Delete</a>
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