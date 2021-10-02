<?php
$remove = db_execute('DELETE FROM users WHERE username=:username', [':username' => $_GET['username']]);
?>

<table class="table table-dark table-hover table-striped table-borderless table">
    <thead>
    <tr>
        <th scope="col" class="text-center m-auto">Sikeres törlés! <a class="btn-primary ms-3 btn-sm text-decoration-none" href="?p=staffs">Ok</a></th>
    </tr>
    </thead>
</table>
