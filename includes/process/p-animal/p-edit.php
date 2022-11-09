<?php
include "../../../UI_include.php";
include INC_DIR."/process/p-login.php";
include INC_DIR.'header.html';
include_once INC_DIR.'/classes/Animal.php';
include_once INC_DIR.'/classes/AllViews.php';
//  ----------------------------------------------------------------

$id = -1;
$animalType = '';
$quantity = '';
$state = '';
$price = 0.0;
$cost = 0.0;
$barnID = 1;
$supplierID = 1;

$errorMsg = '';
$sucessMsg = '';

define("REDIRECT", "location: ../../../animal.php");

$views = new AllViews();

$suppliersNames = $views->getSuplliersView();
$categoriesNames = $views->getCategoriesView();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['id'])) {
        header(REDIRECT);
        exit;
    }

    $id = $_GET['id'];
    $animals = new Animal();
    $animal = $animals->getAnimal($id);
    if (!$animal) {
        header(REDIRECT);
        exit;
    }

    $animalType = $animal['animal_categories_id'];
    $quantity = $animal['quantity'];
    $state = $animal['state'];
    $price = $animal['price'];
    $cost = $animal['cost'];
    $barnID = $animal['barn_id'];
    $supplierID = $animal['supplier_id'];

} else {

    $id = $_POST['id'];
    $animalType = $_POST['animalType'];
    $quantity = $_POST['quantity'];
    $state = $_POST['state'];
    $price = $_POST['price'];
    $cost = $_POST['cost'];
    $barnID = $_POST['barnID'];
    $supplierID = $_POST['supplierID'];

    do {
        if (empty($animalType) || empty($quantity) || empty($price)
         || empty($cost) || empty($barnID) || empty($supplierID)) {
            $errorMsg = 'Please fill the required fields';
            break;
        }

        $animal = new Animal();
        $animal->setValues($animalType, $quantity, $state, $price, $cost, $barnID, $supplierID);
        $animal->updateAnimal($id);

        $sucessMsg = 'Animal Cycle added successfully';
        header(REDIRECT);
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
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Animal Type</label>
                <div class="col-sm-6">
                    <select name="animalType" class="form-select" aria-label="Default select example">
                        <option class="d-none" selected value="<?php echo $animalType; ?>"><?php echo $views->getCategoryName($animalType); ?></option>
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
                        <option class="d-none" selected value="<?php echo $state ?>"><?php echo $state ?></option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
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
                        <option class="d-none" selected value="<?php echo $supplierID; ?>"><?php echo $views->getSupllierName($supplierID); ?></option>
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
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="../../../animal.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>