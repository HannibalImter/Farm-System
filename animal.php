<?php
    include "UI_include.php";
    include INC_DIR."/process/p-login.php";
    include INC_DIR.'header2.html';
    include_once 'includes/classes/Animal.php';
    include_once 'includes/classes/AllViews.php';
?>


<body>

    <div class="container my-2">
        <h2>List Of Animals Cycles</h2>
        <a href="includes/process/p-animal/p-add-cycle.php" class="btn btn-primary" role="button">New Cycle</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Quantity</th>
                    <th>State</th>
                    <th>Price</th>
                    <th>Cost</th>
                    <th>BarnID</th>
                    <th>SupplierID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $animals = new Animal();
                // TODO: replace this view with animal view.
                $view = new AllViews();
                
                $result = $animals->getAllAnimals();

                if (!$result) {
                    die("can not found!");
                }
                foreach ($result as $key => $value) {
                    $rowClass = '';
                    $doneBtnClass = '';

                    $catName = $view->getCategoryName($value['animal_categories_id']);
                    $supName = $view->getSupllierName($value['supplier_id']);

                    if (!is_null($value['end_date'])) {
                        $rowClass = 'table-primary';
                        $doneBtnClass .= 'disabled';
                    } elseif ($value['state'] == 'Inactive') {
                        $rowClass = 'table-secondary';
                        $doneBtnClass .= 'disabled';
                    }

                    echo "
                        <tr class=$rowClass>
                        <td>$value[id]</td>
                        <td>$catName</td>
                        <td>$value[start_date]</td>
                        <td>$value[end_date]</td>
                        <td>$value[quantity]</td>
                        <td>$value[state]</td>
                        <td>$value[price]</td>
                        <td>$value[cost]</td>
                        <td>$value[barn_id]</td>
                        <td>$supName</td>
                        <td>
                            <a class='btn btn-primary btn-sm'
                             href='includes/process/p-animal/p-edit.php?id=$value[id]'>Edit</a>
                            <a class='btn btn-danger btn-sm'
                              href='includes/process/p-animal/p-delete.php?id=$value[id]'>Delete</a>
                            <a class='btn btn-success btn-sm $doneBtnClass'
                              href='includes/process/p-animal/p-doneCycle.php?id=$value[id]'>Done Cycle</a>
                            <a class='btn btn-info btn-sm $doneBtnClass'
                              href='includes/process/p-animal/p-increase.php?id=$value[id]'>increase Quantity</a>
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