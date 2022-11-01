<?php
include "../../../UI_include.php";
include INC_DIR."/process/p-login.php";
include INC_DIR.'header.html';
include_once INC_DIR.'/classes/Supplier.php';

$name = '';
$phone = '';

$errorMsg = '';
$sucessMsg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $phone = $_POST['phone'];

    do {
        if (empty($name) || empty($phone)) {
            $errorMsg = 'All fields are required';
            break;
        }
        $addSup = new Supplier($name, $phone);
        $addSup->insertNewSupplier();

        $name = '';
        $phone = '';

        $sucessMsg = 'Supplier added successfully';

        header("location: ../../../supplier_form.php");
        exit;

    } while (false);
}




?>

<body>
    
    <div class="container my-5">
        <h2>New Supplier</h2>
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
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
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
                    <a class="btn btn-outline-primary" href="../../../supplier_form.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>



</body>
</html>