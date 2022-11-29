<?php
include "../../../UI_include.php";
include INC_DIR."/process/p-login.php";
include INC_DIR.'header.html';
include_once INC_DIR.'/classes/Barn.php';

$id = -1;
$name = '';
$workersNumber = '';

$errorMsg = '';
$sucessMsg = '';

define("REDIRECT", "location: ../../../barn.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['id'])) {
        header(REDIRECT);
        exit;
    }
    $id = $_GET['id'];
    $s1 = new Barn();
    $sup = $s1->getBarn($id);
    if (!$sup) {
        header(REDIRECT);
        exit;
    }
    $name = $sup['name'];
    $workersNumber = $sup['workers_number'];


} else {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $workersNumber = $_POST['workersNumber'];

    do {
        if (empty($name) || empty($workersNumber)) {
            $errorMsg = 'All fields are required';
            break;
        }

        $barn = new Barn();

        try {
            $barn->setValues($name, $workersNumber);
            $barn->updateBarn($id, $name, $workersNumber);
        } catch (\Throwable $th) {
            $errorMsg = 'Invalid query';
            break;
        }

        $sucessMsg = 'Barn Updated successfully';

        header(REDIRECT);
        exit;

    } while (false);
}
?>

<body>
    <div class="container my-5">
        <h2>Edit Barn</h2>
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
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Workers Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="workersNumber" value="<?php echo $workersNumber; ?>">
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
                    <a class="btn btn-outline-primary" href="../../../barn.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>
