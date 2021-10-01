<?php

require_once 'private/lib/validations/user-register-validate.php';

$modificationCounter = 0;
$firstSet = false;
$errors = [];
$uploadErrors = [];
$errorBorderClass = '';


if(isset($_POST['data-submit'])){


    $errors = validate_user_shipping_data($_POST, $firstSet);

    if(empty($_POST['postal_code'])){
        $_POST['postal_code'] = $_SESSION['user']['postal_code'];

    }else{
        $modificationCounter ++;
    }

    if(empty($_POST['city'])){
        $_POST['city'] = $_SESSION['user']['city'];

    }else{
        $modificationCounter ++;
    }

    if(empty($_POST['street'])){
        $_POST['street'] = $_SESSION['user']['street'];

    }else{
        $modificationCounter ++;
    }

    if(empty($_POST['house_number'])){
        $_POST['house_number'] = $_SESSION['user']['house_number'];

    }else{
        $modificationCounter ++;
    }

    if(empty($errors && isset($_POST['data-submit']))) {
        db_execute('UPDATE users SET postal_code = :postal_code, city = :city, street = :street, house_number = :house_number WHERE username = :username;', [

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
            <h4>Az alábbi adatokat tudja módosítani:</h4>
        </div>


        <div class='input-group <?=  $errors['postal_code'] ? $errorBorderClass : '' ?>  p-3'>
            <label for='lastname' class='me-3'>Irányítószám:</label>
            <input type="text" id="postal_code" name="postal_code" placeholder='<?= $_SESSION['user']['postal_code'] ?>' class='form-control'>
        </div>

        <div class='input-group <?=  $errors['city'] ? $errorBorderClass : '' ?>  p-3'>
            <label for='firstname' class='me-3'>Város:</label>
            <input type="text" id="city" name="city" placeholder='<?= $_SESSION['user']['city'] ?>' class='form-control'>
        </div>


        <div class='input-group <?=  $errors['street'] ? $errorBorderClass : '' ?>  p-3'>
            <label for='phone_number' class='me-3'>Utca:</label>
            <input type="text" id="street" name="street" placeholder='<?= $_SESSION['user']['street'] ?>' class='form-control'>
        </div>


        <div class='input-group <?=  $errors['house_number'] ? $errorBorderClass : '' ?>  p-3'>
            <label for='phone_number' class='me-3'>Házszám:</label>
            <input type="text" id="house_number" name="house_number" placeholder='<?= $_SESSION['user']['house_number'] ?>' class='form-control'>
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

<?php elseif(isset($_POST['data-submit']) && $modificationCounter == 0): ?>

    <table class="table table-dark table-hover table-striped table-borderless table">

        <thead>
        <tr>
            <th scope="col" class="text-center m-auto">Ön nem módosította az adatait! <a class="btn-primary ms-3 btn-sm text-decoration-none" href="?p=user-data">Ok</a></th>
        </tr>
        </thead>
    </table>

<?php else: ?>
    <?php $user = db_fetch('users', 'username LIKE :username', [':username' => $_SESSION['user']['username']]); ?>
    <?php $_SESSION['user'] = $user; ?>
    <table class="table table-dark table-hover table-striped table-borderless table">

        <thead>
        <tr>
            <th scope="col" class="align-middle text-center m-auto">Sikeresen módosította az adatait! <a class="btn-primary ms-3 btn-sm text-decoration-none" href="?p=user-data">Ok</a></th>
        </tr>
        </thead>
    </table>
<?php endif; ?>
