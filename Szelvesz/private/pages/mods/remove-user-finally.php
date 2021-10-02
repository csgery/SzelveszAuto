<?php
$deleted = db_execute('DELETE FROM users WHERE username=:username', [':username' => $_SESSION['user']['username']]);

if($deleted['affected'] != 0){
session_unset();
session_destroy();
}
?>

<?php if($deleted['affected'] != 0): ?>
    <table class="table table-dark table-hover table-striped table-borderless table">
        <thead>
        <tr>
            <th scope="col" class="text-center m-auto">Sikeresen törölte fiókját!<a class="btn btn-primary ms-3 btn-sm" href="?p=home">Ok</a>
        </tr>
        </thead>
    </table>
<?php else:?>
    <table class="table table-dark table-hover table-striped table-borderless table">
        <thead>
        <tr>
            <th scope="col" class="text-center m-auto">Nem sikerült a törlés. Kérjük vegye fel a kapcsolatot a rendszergazdával! <a class="btn btn-primary ms-3 btn-sm" href="?p=home">Ok</a>
        </tr>
        </thead>
    </table>
<?php endif; ?>