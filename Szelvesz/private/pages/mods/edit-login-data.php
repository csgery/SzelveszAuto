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

    
    if(empty($errors && isset($_POST['data-submit']))) {
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

<?php if(!isset($_POST['data-submit']) || $errors): ?>

<div class="card mt-md-auto p-5 align-middle align-content-center">
    <form method="post" enctype="multipart/form-data" class="form">
        <div class='card-header mb-2'>
            <h4>Az alábbi adatokat tudja módosítani:</h4>
        </div>

        <div class='input-group <?=  $errors['username'] ? $errorBorderClass : '' ?>  p-3'>
            <label for='username' class='me-3'>Felhasználónév:</label>
            <input type="text" id="username" name="username" placeholder='<?= $_SESSION['user']['username'] ?>' class='form-control'>
        </div>


        <div class='input-group <?=  $errors['email'] ? $errorBorderClass : '' ?>  p-3'>
            <label for='email' class='me-3'>Email:</label>
            <input type="email" id="email" name="email" placeholder='<?= $_SESSION['user']['email'] ?>' class='form-control'>
        </div>

        <div class='input-group <?=  $errors['password'] ? $errorBorderClass : '' ?>  p-3'>
            <label for='password' class='me-3'>Jelszó:</label>
            <input type="password" id="password" name="password" placeholder='********' class='form-control'>
        </div>

        <div class='input-group <?=  $errors['password'] ? $errorBorderClass : '' ?>  p-3'>
            <label for='password_confirmation' class='me-3'>Jelszó újra:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder='********' class='form-control'>
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
        <th scope="col" class="text-center m-auto">Ön nem módosította az adatait! <a class="btn btn-primary ms-3 btn-sm" href="?p=login-data">Ok</a></th>
    </tr>
    </thead>
</table>

<?php else: ?>

<table class="table table-dark table-hover table-striped table-borderless table">

    <thead>
    <tr>
        <th scope="col" class="align-middle text-center m-auto">Sikeresen módosította az adatait! <a class="btn btn-primary btn-sm" href="?p=login-data">Ok</a></th>
    </tr>
    </thead>
</table>
<?php endif; ?>