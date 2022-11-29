<?php
include "../../../UI_include.php";
include INC_DIR."/process/p-login.php";
include INC_DIR.'header.html';
include_once INC_DIR.'/classes/Action.php';

$id = -1;
$type = '';
$description = '';

$errorMsg = '';
$sucessMsg = '';

define("REDIRECT", "location: ../../../action.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['id'])) {
        header(REDIRECT);
        exit;
    }
    $id = $_GET['id'];
    $a1 = new Action();
    $sup = $a1->getAction($id);
    if (!$sup) {
        header(REDIRECT);
        exit;
    }
    $type = $sup['type'];
    $description = $sup['description'];


} else {
    $id = $_POST['id'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    do {
        if (empty($type) || empty($description)) {
            $errorMsg = 'All fields are required';
            break;
        }

        $action = new Action();

        try {
            $action->setValues($type, $description);
            $action->updateAction($id);
        } catch (\Throwable $th) {
            $errorMsg = 'Invalid query';
            break;
        }

        $sucessMsg = 'Action Updated successfully';

        header(REDIRECT);
        exit;

    } while (false);
}
?>

<body>
    <div class="container my-5">
        <h2>Edit Action</h2>
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
                <label class="col-sm-3 col-form-label">type</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="type" value="<?php echo $type; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
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
