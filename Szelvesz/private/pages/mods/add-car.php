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

