<?php if(!isset($_SESSION['user']['lastname'])):?>
<table class="table table-dark table-hover table-striped table-borderless table">
    <thead>
    <tr>
        <th scope="col" class="text-center m-auto">Vásárlás előtt kérjük adja meg a szükséges adatokat!<a class="btn btn-primary ms-3 btn-sm" href="?p=mods/set-user-data">Adatok megadása</a></th>
    </tr>
    </thead>
</table>

<?php else: ?>
    <?php $user = db_fetch('users', 'username LIKE :username', [':username' => $_SESSION['user']['username']]); ?>
    <?php $car = db_fetch('cars', 'id LIKE :car_id', [':car_id' => $_GET['id']]); ?>
    <table class="table table-dark table-hover table-striped table-borderless text-center mx-auto mt-5">
        <thead>
            <tr>
                <th scope="col" colspan="5" class="text-warning">Rendelés előtt kérem ellenőrizze:</th>
            </tr>

            <tr>
                <th scope="col" colspan="5" class="text-primary">Személyes adatok</th>
            </tr>
            <tr>
                <th scope="col">Vezetéknév</th>
                <th scope="col">Keresztnév</th>
                <th scope="col">Email</th>
                <th scope="col">Telefonszám</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td scope="row"> <?= $user['lastname'] ?> </td>
                <td><?= $user['firstname'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['phone_number'] ?></td>
            </tr>
        </tbody>

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
            <th scope="row" colspan="2"><a href="?p=mods/edit-user-personal-data" class="text-decoration-none text-center">Személyes adatok módosítása</a></th>
            <th scope="row" colspan="2"><a href="?p=mods/edit-user-shipping-data" class="text-decoration-none text-center p-lg-3">Szállítási adatok módosítása</a></th>
        </tfoot>

    </table>
<?php endif; ?>

