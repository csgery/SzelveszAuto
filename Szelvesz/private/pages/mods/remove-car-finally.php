<?php
db_execute('UPDATE cars SET is_deleted = :is_deleted WHERE id = :id;', [

    ':is_deleted' => 1,
    ':id' => $_GET['id']

]);
?>


<table class="table table-dark table-hover table-striped table-borderless table">

    <thead>
    <tr>
        <th scope="col" class="text-center m-auto">Sikeres törlés!<a class="btn btn-primary ms-3 btn-sm" href="?p=cars">Ok</a>
    </tr>
    </thead>
</table>