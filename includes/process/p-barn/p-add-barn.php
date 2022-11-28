<?php
include "../../../UI_include.php";
include INC_DIR."/process/p-login.php";
include INC_DIR.'header.html';
include_once INC_DIR.'/classes/Barn.php';

$errorMsg = '';
$sucessMsg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $workersNumber = $_POST['workersNumber'];

    do {
        if (empty($name) || empty($workersNumber)) {
            $errorMsg = 'All fields are required';
            break;
        }
        $addSup = new Barn($name, $workersNumber);
        $addSup->insertNewBarn();

        $name = '';
        $workersNumber = '';

        $sucessMsg = 'Barn added successfully';

        header("location: ../../../barn.php");
        exit;

    } while (false);
}




?>

<body>
    <div class="container my-5">
        <h2>New Barn</h2>
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
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Workers Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="workersNumber">
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
                    <a class="btn btn-outline-primary" href="../../../barn.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>



</body>
</html>