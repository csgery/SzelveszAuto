<?php

$errors = [];
$errorBorderClass = '';
if(isset($_POST['submit'])) {
    $user = db_fetch('users', 'username LIKE :username', [':username' => $_POST['username']]);

    if(password_verify($_POST['password'], $user['password'])){
        $_SESSION['user'] = $user;
    }else{
        $errors['_'][] = 'Helytelen felhasználónév/jelszó!';
        $errorBorderClass = 'border border-danger mb-3';
    }

}


?>


<?php if(!isset($_SESSION['user'])): ?>
    <div class="card mt-md-auto p-5 align-middle align-content-center">
        <form method="post" enctype="multipart/form-data" class="form">
            <div class='card-header mb-2'>
                <h4>Bejelentkezés</h4>
            </div>

            <div class='input-group <?=  $errors ? $errorBorderClass : '' ?>  p-3'>
                <label for='username' class='me-3'>Felhasználónév</label>
                <input type="username" id="username" name="username" placeholder='Felhasználónév' class='form-control'>
            </div>

            <div class='input-group <?=  $errors ? $errorBorderClass : '' ?>  p-3'>
                <label for='password' class='me-3'>Jelszó</label>
                <input type="password" id="password" name="password" placeholder='********' class='form-control'>
            </div>

            <?php if ($errors): ?>
                <div class="alert alert-danger">
                    <h5><?= $errors['_'][0];?></h5>
                </div>
            <?php endif; ?>
            <div class='input-group'>
                <input name ="submit" id="submit" type="submit" value="Bejelentkezés" class='btn btn-primary' >

            </div>
        </form>
    </div>
    </div>

<?php else: ?>
    <table class="table table-dark table-hover table-striped table-borderless table">

        <thead>
        <tr>

            <th scope="col" class="text-center m-auto">Üdvözöljük <?= $_SESSION['user']['username'] ?>!<a class="btn-primary ms-3 btn-sm text-decoration-none" href="?p=home">Ok</a></th>

        </tr>
        </thead>
    </table>
<?php endif; ?>