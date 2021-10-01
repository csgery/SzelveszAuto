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


<?php if(!isset($_POST['data-submit']) || $errors): ?>

<div class="card mt-md-auto p-5 align-middle align-content-center">
    <form method="post" enctype="multipart/form-data" class="form">
        <div class='card-header mb-2'>
            <h4>Az alábbi adatokat tudja módosítani:</h4>
        </div>

        <div class='input-group <?=  $errors['lastname'] ? $errorBorderClass : '' ?>  p-3'>
            <label for='lastname' class='me-3'>Vezetéknév:</label>
            <input type="text" id="lastname" name="lastname" placeholder='<?= $_SESSION['user']['lastname'] ?>' class='form-control'>
        </div>

        <div class='input-group <?=  $errors['firstname'] ? $errorBorderClass : '' ?>  p-3'>
            <label for='firstname' class='me-3'>Keresztnév:</label>
            <input type="text" id="firstname" name="firstname" placeholder='<?= $_SESSION['user']['firstname'] ?>' class='form-control'>
        </div>

        <div class='input-group <?=  $errors['phone_number'] ? $errorBorderClass : '' ?>  p-3'>
            <label for='phone_number' class='me-3'>Telefonszám:</label>
            <input type="text" id="phone_number" name="phone_number" placeholder='<?= $_SESSION['user']['phone_number'] ?>' class='form-control'>
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