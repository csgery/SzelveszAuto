<?php

require_once 'private/lib/validations/user-register-validate.php';
require_once 'private/lib/validations/file-upload.php';

$modificationCounter = 0;
$errors = [];
$errorBorderClass = '';


if(isset($_POST['data-submit'])){

    $errors = validate_user_login_edit($_POST);

    if(empty($_POST['username'])){
        $_POST['username'] = $_SESSION['user']['username'];

    }else{
        $modificationCounter ++;
    }

    if(empty($_POST['email'])){
        $_POST['email'] = $_SESSION['user']['email'];

    }else{
        $modificationCounter ++;
    }

    if(empty($_POST['password'])){
        $_POST['password'] = $_SESSION['user']['password'];

    }else{
        $modificationCounter ++;
    }

    
    if(empty($errors)) {
        db_execute('UPDATE users SET username = :username, email = :email, password = :password WHERE username = :IDusername;', [

            ':username' => $_POST['username'],
            ':email' => $_POST['email'],
            ':password' => password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 12]),

            ':IDusername' => $_SESSION['user']['username']
        ]);
        $user = db_fetch('users', 'username LIKE :username', [':username' => $_POST['username']]);
        $_SESSION['user'] = $user;
    }
}
?>