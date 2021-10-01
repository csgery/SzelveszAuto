<?php
?>

<?php if(isset($_SESSION['user']['lastname']) && isset($_SESSION['user']['city'])): ?>
    <?php $user = db_fetch('users', 'username LIKE :username', [':username' => $_SESSION['user']['username']]); ?>
    <table class="table table-dark table-hover table-striped table-borderless align-middle mx-auto mt-5 text-center ">
        <thead>
            <tr>
                <th scope="col" colspan="4" class="text-primary">Személyes adatok</th>
            </tr>
            <tr>
                <th scope="col">Vezetéknév</th>
                <th scope="col">Keresztnév</th>
                <th scope="col">Telefonszám</th>
            </tr>
        </thead>

        <tbody>

        <tr>
            <td scope="row"> <?= $user['lastname'] ?> </td>
            <td><?= $user['firstname'] ?></td>
            <td><?= $user['phone_number'] ?></td>
        </tr>

        </tbody>

        <tfoot>
            <th scope="row" colspan="7"><a href="?p=mods/edit-user-personal-data" class="text-decoration-none">Személyes adatok módosítása</a></th>
        </tfoot>


    </table>

    <table class="table table-dark table-hover table-striped table-borderless align-middle mx-auto mt-5 text-center ">
        <thead>
            <tr>
                <th scope="col" colspan="4" class="text-primary">Szállítási adatok</th>
            </tr>
            <tr>
                <th scope="col">Irányítószám</th>
                <th scope="col">Város</th>
                <th scope="col">Utca</th>
                <th scope="col">Házszám</th>

            </tr>
        </thead>

        <tbody>
            <tr>
                <td scope="row"> <?= $user['postal_code'] ?> </td>
                <td><?= $user['city'] ?></td>
                <td><?= $user['street'] ?></td>
                <td><?= $user['house_number'] ?></td>
            </tr>
        </tbody>

        <tfoot>
            <th scope="row" colspan="8"><a href="?p=mods/edit-user-shipping-data" class="text-decoration-none">Szállítási adatok módosítása</a></th>
        </tfoot>

    </table>
<?php else: ?>
    <table class="table table-dark table-hover table-striped table-borderless table">
        <thead>
        <tr>
            <th scope="col" class="text-center m-auto">Ön még egyetlen személyes adatot sem adott meg! <a class="btn btn-primary ms-3 btn-sm " href="?p=mods/set-user-data">Adatok megadása</a></th>
        </tr>
        </thead>
    </table>
<?php endif;?>