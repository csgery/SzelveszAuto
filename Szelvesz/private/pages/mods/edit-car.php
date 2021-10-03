<?php


$modificationCounter = 0;
$imageModified = false;
$errors = [];
$uploadErrors = [];
$errorBorderClass = '';




if(isset($_GET['id'])){
    $car = db_fetch('cars','id = :id', [':id' => $_GET['id']]);

    if(isset($_POST['submit'])) {



        require_once 'private/lib/validations/car-register-validate.php';
        require_once 'private/lib/utils/file.php';
        require_once 'private/lib/validations/file-upload.php';

        $errors = validate_car_edit($_POST);
        $fileType = getExtension(uploads($_FILES['image']['name']));
        $tmpPath = $_FILES['image']['tmp_name'];
        $targetPath = uploads(uniqid('file_', true)) . ".$fileType";



        if (empty($errors)) {

            if(empty($tmpPath)){
                $targetPath = $car['image'];
            } else{
                $uploadErrors = validateFileUpload($tmpPath, $targetPath, $fileType);
                if (!$uploadErrors && !move_uploaded_file($tmpPath, $targetPath)) {
                    $uploadErrors['_'][] = 'Hiba történt a kép feltöltése során.';
                }
                $modificationCounter ++;
                $imageModified = true;



            }

            if(empty($_POST['name'])){
                $_POST['name'] = $car['name'];

            }else{
                $modificationCounter ++;
            }

            if(empty($_POST['model'])){
                $_POST['model'] = $car['model'];

            }else{
                $modificationCounter ++;
            }

            if(empty($_POST['colour'])){
                $_POST['colour'] = $car['colour'];

            }else{
                $modificationCounter ++;
            }

            if(empty($_POST['price'])){
                $_POST['price'] = $car['price'];

            }else{
                $modificationCounter ++;
            }


            if(!$imageModified){

                if($modificationCounter > 0) {
                    $carInDB = db_fetch('cars', 'name LIKE :name AND model LIKE :model AND colour LIKE :colour AND price LIKE :price AND is_deleted = 0', [
                        ':name' => $_POST['name'],
                        ':model' => $_POST['model'],
                        ':colour' => $_POST['colour'],
                        ':price' => $_POST['price']
                    ]);

                    if ($carInDB) {
                        $errors ['notUnique'][] = 'Ez az autó már fel van töltve!';
                    }
                }

            }




            if(empty($uploadErrors) && empty($carInDB)) {

                if(!$imageModified) {
                    db_execute('UPDATE cars SET image = :image, name = :name, model = :model, colour = :colour, price = :price WHERE id = :id', [
                        ':id' => $_GET['id'], 
                        ':image' => $targetPath,
                        ':name' => $_POST['name'],
                        ':model' => $_POST['model'],
                        ':colour' => $_POST['colour'],
                        ':price' => $_POST['price'],
                    ]);
                }else{
                    db_execute('UPDATE cars SET image = :image WHERE id = :id', [
                        ':id' => $_GET['id'], 
                        ':image' => $targetPath
                    ]);




                }

            }

        }

    }
}
else{
    $errors['_'][]= "Hiba a GET['id']-ben.";
}


?>

<?php if(!isset($_POST['submit']) || $errors || $uploadErrors):?>
    <div class="card mt-md-auto p-5 align-middle align-content-center">
        <form method="post" enctype="multipart/form-data" class="form">
            <div class='card-header mb-2'>
                <h4>Kérem adja meg a módosítandó adatokat:</h4>
            </div>

            <div class='input-group <?=  $uploadErrors ? $errorBorderClass : '' ?>  p-3'>
                <label for='image' class='me-3'>Autó képe:</label>
                <input type="file" id="image" name="image" class='form-control'>
            </div>


            <div class='input-group <?=  $errors['name'] ? $errorBorderClass : '' ?>  p-3'>
                <label for='name' class='me-3'>Autó neve:</label>
                <input type="text" id="name" name="name" placeholder='Eredetileg: <?= $car['name']?>' class='form-control'>
            </div>

            <div class='input-group <?=  $errors['model'] ? $errorBorderClass : '' ?>  p-3'>
                <label for='model' class='me-3'>Modell:</label>
                <input type="text" id="model" name="model" placeholder='Eredetileg: <?= $car['model']?>' class='form-control'>
            </div>



            <div class='input-group <?=  $errors['colour'] ? $errorBorderClass : '' ?>  p-3'>
                <label for='colour' class='me-3'>Színe:</label>
                <input type="text" id="colour" name="colour" placeholder='Eredetileg: <?= $car['colour']?>' class='form-control'>
            </div>


            <div class='input-group <?=  $errors['price'] ? $errorBorderClass : '' ?>  p-3'>
                <label for='price' class='me-3'>Ára:</label>
                <input type="number" id="price" name="price" placeholder='Eredetileg: <?= $car['price']?>' class='form-control'>
            </div>



            <?php if ($errors || $uploadErrors): ?>
                <div class="alert alert-danger">
                    <h5>A szerkesztés nem sikerült!</h5>
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
                <input name ="submit" id="submit" type="submit" value="Szerkesztés" class='btn btn-primary' >
            </div>
        </form>
    </div>
    </div>


<?php elseif(isset($_POST['submit']) && $modificationCounter == 0): ?>

    <table class="table table-dark table-hover table-striped table-borderless table">

        <thead>
        <tr>
            <th scope="col" class="text-center m-auto">Ön nem módosította a jármű adatait! <a class="btn btn-primary ms-3 btn-sm" href="?p=cars">Ok</a></th>

        </tr>
        </thead>
    </table>


<?php elseif($imageModified): ?>

    <table class="table table-dark table-hover table-striped table-borderless table">

        <thead>
        <tr>
            <th scope="col" class="text-center m-auto">Sikeresen módosította a jármű képét, azonban ha más módosítása is volt, az nem módosult! <a class="btn btn-primary ms-3 btn-sm" href="?p=cars">Ok</a></th>

        </tr>
        </thead>
    </table>


<?php else: ?>

    <table class="table table-dark table-hover table-striped table-borderless table">

        <thead>
        <tr>
            <th scope="col" class="text-center m-auto">Sikeres módosítás!<a class="btn btn-primary ms-3 btn-sm" href="?p=cars">Ok</a></th>

        </tr>
        </thead>
    </table>
<?php endif; ?>