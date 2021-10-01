<?php

require_once 'private/lib/validations/user-register-validate.php';

$errors = [];
$errorBorderClass = '';

function login(){
    $user = db_fetch('users', 'username LIKE :username', [':username' => $_POST['username']]);
    $_SESSION['user'] = $user;


}


if(isset($_POST['submit'])){


        

    if(empty($errors)){
            db_execute('INSERT INTO `users` (username, email, password, auth) VALUES (:username, :email, :password, :auth)', [
                ':id' => uniqid('', true),
                ':username' => $_POST['username'],
                ':email' => $_POST['email'],
                ':password' => password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 12]),
                ':auth' => 2
            ]);
        }

    }
?>

<?php if(!isset($_POST['submit']) || $errors):?>
<div class="card mt-md-auto p-5 align-middle align-content-center">
    <form method="post" enctype="multipart/form-data" class="form">
        <div class='card-header mb-2'>
            <h4>Regisztráció:</h4>
        </div>

        <div class='input-group <?=  $errors['username'] ? $errorBorderClass : '' ?>  p-3'>
            <label for='username' class='me-3'>Felhasználónév:</label>
            <input type="text" id="username" name="username" placeholder='Felhasználónév' class='form-control'>
        </div>

        <div class='input-group <?=  $errors['email'] ? $errorBorderClass : '' ?>  p-3'>
            <label for='email' class='me-3'>Email:</label>
            <input type="text" id="email" name="email" placeholder='Email' class='form-control'>
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
                <h5>A regisztráció nem sikerült!</h5>
                    <?php foreach ($errors as $item): ?>
                        <?php foreach ($item as $error): ?>
                            - <?= $error ?> <br/>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
            </div>

        <?php endif; ?>
        <div class='input-group'>
            <input name ="submit" id="submit" type="submit" value="Regisztráció" class='btn btn-primary' >
        </div>
    </form>
</div>
</div>

<?php else: ?>

    <table class="table table-dark table-hover table-striped table-borderless table">

        <thead>
        <tr>
            <?php login()?>
            <th scope="col" class="text-center m-auto">Sikeres regisztráció! Üdvözöljük <?= $_SESSION['user']['username'] ?><a class="btn-primary ms-3 btn-sm text-decoration-none" href="?p=home">Ok</a></th>

        </tr>
        </thead>
    </table>
<?php endif; ?>