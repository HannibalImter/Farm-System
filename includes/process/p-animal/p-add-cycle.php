<?php
include "../../../UI_include.php";
include INC_DIR."/process/p-login.php";
include INC_DIR.'header.html';
include_once INC_DIR.'/classes/Animal.php';
include_once INC_DIR.'/classes/AllViews.php';
//  ----------------------------------------------------------------

$animalType = '';
$quantity = '';
$state = '';
$price = 0.0;
$cost = 0.0;
$barnID = 1;
$supplierID = 1;

$errorMsg = '';
$sucessMsg = '';

$views = new AllViews();
$suppliersNames = $views->getSuplliersView();
$categoriesNames = $views->getCategoriesView();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $animalType = $_POST['animalType'];
    $quantity = $_POST['quantity'];
    $state = $_POST['state'];
    $price = $_POST['price'];
    $cost = $_POST['cost'];
    $barnID = $_POST['barnID'];
    $supplierID = $_POST['supplierID'];

    do {
        if ($animalType == 'default' || empty($quantity) || empty($price)
         || empty($cost) || empty($barnID) || $supplierID == 'default') {
            $errorMsg = 'Please fill the required fields';
            break;
        }

        $animalCycle = new Animal();
        $animalCycle->setValues($animalType, $quantity, $state, $price, $cost, $barnID, $supplierID);
        $animalCycle->insertNewAnimal();

        $animalType = '';
        $quantity = '';
        $state = '';
        $price = 0.0;
        $cost = 0.0;
        $barnID = 1;
        $supplierID = 1;

        $sucessMsg = 'Animal Cycle added successfully';
        header("location: ../../../animal.php");
        exit;

    } while (false);
}

?>


<body>
    <div class="container my-5">
        <h2>New Animal Cycle</h2>
        <?php
        if (!empty($errorMsg)) {
            echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMsg</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
            ";
        }
        ?>
        <form action="" method="POST">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Animal Type</label>
                <div class="col-sm-6">
                    <select name="animalType" class="form-select" aria-label="Default select example">
                        <option selected value='default'>Please Select A Category</option>
                        <?php
                        foreach ($categoriesNames as $key => $value) {
                            echo "<option value=$value[id]>$value[name]</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Quantity</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="quantity" value="<?php echo $quantity; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">State</label>
                <div class="col-sm-6">
                    <select name="state" class="form-select" aria-label="Default select example">
                        <option selected value="Active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="price" value="<?php echo $price; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Cost</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="cost" value="<?php echo $cost; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Barn-ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="barnID" value="<?php echo $barnID; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Supplier-ID</label>
                <div class="col-sm-6">
                    <select name="supplierID" class="form-select" aria-label="Default select example">
                        <option selected value='default'>Please Select A Supplier</option>
                        <?php
                        foreach ($suppliersNames as $key => $value) {
                            echo "<option value=$value[id]>$value[name]</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <?php
            if (!empty($sucessMsg)) {
                echo "
                    <div class='row mb-3'>
                        <div class='offset-sm-3 col-sm-6'>
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$sucessMsg</strong>
                                <button type='button' class='btn-close'
                                 data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        </div>
                    </div>
                ";
            }
        ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button class="btn btn-primary" type="submit">Add</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="../../../animal.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>