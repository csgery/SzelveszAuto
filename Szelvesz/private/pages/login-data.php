<?php
?>


<table class="table table-dark table-hover table-striped table-borderless align-middle mx-auto mt-5 text-center ">
    
    <thead>
        <tr>
            <th scope="col" colspan="3" class="text-primary align-middle text-center">Bejelentkezési adatok</th>
        </tr>
        <tr>
            <th class="align-middle text-center" scope="col">Felhasználónév</th>
            <th class="align-middle text-center" scope="col">Email</th>
            <th class="align-middle text-center" scope="col">Jelszó</th>
        </tr>
    </thead>
    
    <tbody>
        <tr>
            <td scope="row"> <?= $_SESSION['user']['username'] ?> </td>
            <td><?= $_SESSION['user']['email'] ?></td>
            <td>********</td>
        </tr>
    </tbody>

    <tfoot>
        <th scope="row" colspan="3">
            <a href="?p=mods/edit-login-data" class="text-decoration-none">Bejelentkezési adatok módosítása</a>
        </th>
    </tfoot>


</table>