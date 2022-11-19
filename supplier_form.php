<?php
    include "UI_include.php";
    include INC_DIR."/process/p-login.php";
    include INC_DIR.'header2.html';
    include_once 'includes/classes/Supplier.php';
?>


    <div class="container my-5">
        <h2>List Of Suppliers</h2>
        <a href="includes/process/p-supplier/p-add-supplier.php" class="btn btn-primary" role="button">New Supplier</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Supplier ID</th>
                    <th>Supplier Name</th>
                    <th>Supplier Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $suppliers = new Supplier();
                $result = $suppliers->getAllSuppliers();
                if (!$result) {
                    die("con not found!");
                }
                foreach ($result as $key => $value) {
                    echo "
                        <tr>
                        <td>$value[id]</td>
                        <td>$value[name]</td>
                        <td>$value[phone]</td>
                        <td>
                            <a class='btn btn-primary btn-sm'
                             href='includes/process/p-supplier/p-edit.php?id=$value[id]'>Edit</a>
                            <a class='btn btn-danger btn-sm'
                              href='includes/process/p-supplier/p-delete.php?id=$value[id]'>Delete</a>
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