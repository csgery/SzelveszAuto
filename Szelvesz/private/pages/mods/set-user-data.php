<?php

require_once 'private/lib/validations/user-register-validate.php';

$firstSet = true;
$errors = [];
$errorBorderClass = "";

if(isset($_POST['data-submit'])) {
    $errors = validate_user_personal_data($_POST, $firstSet);
    $errors += validate_user_shipping_data($_POST, $firstSet);


    if (empty($errors && isset($_POST['data-submit']))) {
        db_execute('UPDATE users SET firstname = :firstname, lastname = :lastname, phone_number = :phone_number, 
                     postal_code = :postal_code, city = :city, street = :street, house_number = :house_number
                     WHERE username = :username;', [

            ':firstname' => $_POST['firstname'],
            ':lastname' => $_POST['lastname'],
            ':phone_number' => $_POST['phone_number'],
            ':postal_code' => $_POST['postal_code'],
            ':city' => $_POST['city'],
            ':street' => $_POST['street'],
            ':house_number' => $_POST['house_number'],
            ':username' => $_SESSION['user']['username']
        ]);
    }
}

?>