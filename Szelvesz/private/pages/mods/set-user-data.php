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

<?php if(!isset($_POST['data-submit']) || $errors): ?>
    <div class="card mt-md-auto p-5 align-middle align-content-center">
        <form method="post" enctype="multipart/form-data" class="form">
            <div class='card-header mb-2'>
                <h4>A vásárláshoz kérem adja meg a következő adatokat:</h4>
            </div>

            <div class='input-group <?=  $errors['lastname'] ? $errorBorderClass : '' ?>  p-3'>
                <label for='lastname' class='me-3'>Vezetéknév:</label>
                <input type="text" id="lastname" name="lastname" placeholder='' class='form-control'>
            </div>

            <div class='input-group <?=  $errors['firstname'] ? $errorBorderClass : '' ?>  p-3'>
                <label for='firstname' class='me-3'>Keresztnév:</label>
                <input type="text" id="firstname" name="firstname" placeholder='' class='form-control'>
            </div>


            <div class='input-group <?=  $errors['phone_number'] ? $errorBorderClass : '' ?>  p-3'>
                <label for='phone_number' class='me-3'>Telefonszám:</label>
                <input type="text" id="phone_number" name="phone_number" placeholder='' class='form-control'>
            </div>


            <div class='input-group <?=  $errors['postal_code'] ? $errorBorderClass : '' ?>  p-3'>
                <label for='postal_code' class='me-3'>Irányítószám:</label>
                <input type="text" id="postal_code" name="postal_code" placeholder='' class='form-control'>
            </div>


            <div class='input-group <?=  $errors['city'] ? $errorBorderClass : '' ?>  p-3'>
                <label for='city' class='me-3'>Város:</label>
                <input type="text" id="city" name="city" placeholder='' class='form-control'>
            </div>


            <div class='input-group <?=  $errors['street'] ? $errorBorderClass : '' ?>  p-3'>
                <label for='street' class='me-3'>Utca:</label>
                <input type="text" id="street" name="street" placeholder='' class='form-control'>
            </div>


            <div class='input-group <?=  $errors['house_number'] ? $errorBorderClass : '' ?>  p-3'>
                <label for='house_number' class='me-3'>Házszám:</label>
                <input type="text" id="house_number" name="house_number" placeholder='' class='form-control'>
            </div>


            <?php if ($errors): ?>
                <div class="alert alert-danger">
                    <h5>A jóváhagyás nem sikerült!</h5>
                    <?php foreach ($errors as $item): ?>
                        <?php foreach ($item as $error): ?>
                            - <?= $error ?> <br/>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>

            <?php endif; ?>
            <div class='input-group'>
                <input name ="data-submit" id="data-submit" type="submit" value="Adatok jóváhagyása" class='btn btn-primary' >
            </div>
        </form>
    </div>
    </div>

<?php else: ?>
    <?php $user = db_fetch('users', 'username LIKE :username', [':username' => $_SESSION['user']['username']]); ?>
    <?php $_SESSION['user'] = $user; ?>
    <table class="table table-dark table-hover table-striped table-borderless table">

        <thead>
            <tr>
                <th scope="col" class="align-middle text-center m-auto">Sikeresen megadta a szükséges adatokat! <a class="btn-primary btn-sm text-decoration-none" href="?p=user-data">Ok</a></th>
            </tr>
        </thead>
    </table>

<?php endif; ?>