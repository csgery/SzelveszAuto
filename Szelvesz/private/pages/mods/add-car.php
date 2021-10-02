<?php

$errors = [];
$uploadErrors = [];
$errorBorderClass = '';


if(isset($_POST['submit'])) {

    require_once 'private/lib/validations/car-register-validate.php';
    require_once 'private/lib/utils/file.php';
    require_once 'private/lib/validations/file-upload.php';

    $errors = validate_car_reg($_POST);
    $fileType = getExtension(uploads($_FILES['image']['name']));
    $tmpPath = $_FILES['image']['tmp_name'];
    $targetPath = uploads(uniqid('file_', true)) . ".$fileType";



    $uploadErrors = validateFileUpload($tmpPath, $targetPath, $fileType);

    if(!$uploadErrors && !move_uploaded_file($tmpPath, $targetPath)){
        $uploadErrors['_'][] = 'Hiba történt a kép feltöltése során.';
    }

    else{



        if(empty($errors) && empty($uploadErrors)) {
            db_execute('INSERT INTO cars (id, image, name, model, colour, price) VALUES (:id, :image, :name, :model, :colour, :price)', [
                ':id' => uniqid('', true),
                ':image' => $targetPath,
                ':name' => $_POST['name'],
                ':model' => $_POST['model'],
                ':colour' => $_POST['colour'],
                ':price' => $_POST['price'],
            ]);
        }

    }





}

?>

<?php if(!isset($_POST['submit']) || $errors || $uploadErrors):?>
    <div class="card mt-3 mb-3 p-5 align-middle align-content-center">
        <form method="post" enctype="multipart/form-data" class="form">
            <div class='card-header mb-2'>
                <h4>Kérem adja meg a következő adatokat:</h4>
            </div>

            <div class='input-group <?=  $uploadErrors ? $errorBorderClass : '' ?>  p-3'>
                <label for='image' class='me-3'>Autó képe:</label>
                <input type="file" id="image" name="image" class='form-control'>
            </div>


            <div class='input-group <?=  $errors['name'] ? $errorBorderClass : '' ?>  p-3'>
                <label for='name' class='me-3'>Autó neve:</label>
                <input type="text" id="name" name="name" placeholder='' class='form-control'>
            </div>

            <div class='input-group <?=  $errors['model'] ? $errorBorderClass : '' ?>  p-3'>
                <label for='model' class='me-3'>Modell:</label>
                <input type="text" id="model" name="model" placeholder='' class='form-control'>
            </div>



            <div class='input-group <?=  $errors['colour'] ? $errorBorderClass : '' ?>  p-3'>
                <label for='colour' class='me-3'>Színe:</label>
                <input type="text" id="colour" name="colour" placeholder='' class='form-control'>
            </div>


            <div class='input-group <?=  $errors['price'] ? $errorBorderClass : '' ?>  p-3'>
                <label for='price' class='me-3'>Ára:</label>
                <input type="number" id="price" name="price" placeholder='' class='form-control'>
            </div>



            <?php if ($errors || $uploadErrors): ?>
                <div class="alert alert-danger">
                    <h5>A hozzáadás nem sikerült!</h5>
                    <?php foreach ($uploadErrors as $item): ?>
                        <?php foreach ($item as $error): ?>
                            - <?= $error ?> <br/>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    <?php foreach ($errors as $item): ?>
                        <?php foreach ($item as $error): ?>
                            - <?= $error ?> <br/>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>

            <?php endif; ?>
            <div class='input-group'>
                <input name ="submit" id="submit" type="submit" value="Hozzáad" class='btn btn-primary' >
            </div>
        </form>
    </div>
    </div>

<?php else: ?>

    <table class="table table-dark table-hover table-striped table-borderless table">

        <thead>
        <tr>
            <th scope="col" class="text-center m-auto">Sikeres hozzáadás!<a class="btn-primary ms-3 btn-sm text-decoration-none" href="?p=cars">Ok</a></th>

        </tr>
        </thead>
    </table>
<?php endif; ?>