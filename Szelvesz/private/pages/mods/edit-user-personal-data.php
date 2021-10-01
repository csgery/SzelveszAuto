<?php

require_once 'private/lib/validations/user-register-validate.php';

$modificationCounter = 0;
$firstSet = false;
$errors = [];
$errorBorderClass = '';


if(isset($_POST['data-submit'])){


    $errors = validate_user_personal_data($_POST, $firstSet);

    if(empty($_POST['lastname'])){
        $_POST['lastname'] = $_SESSION['user']['lastname'];

    }else{
        $modificationCounter ++;
    }

    if(empty($_POST['firstname'])){
        $_POST['firstname'] = $_SESSION['user']['firstname'];

    }else{
        $modificationCounter ++;
    }


    if(empty($_POST['phone_number'])){
        $_POST['phone_number'] = $_SESSION['user']['phone_number'];

    }else{
        $modificationCounter ++;
    }

    if(empty($errors && isset($_POST['data-submit']))) {
        db_execute('UPDATE users SET firstname = :firstname, lastname = :lastname ,phone_number = :phone_number WHERE username = :username;', [

            ':firstname' => $_POST['firstname'],
            ':lastname' => $_POST['lastname'],
            ':phone_number' => $_POST['phone_number'],

            ':username' => $_SESSION['user']['username']
        ]);
    }
}

?>
