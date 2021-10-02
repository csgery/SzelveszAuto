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

