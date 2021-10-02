<?php

if(isset($_POST['shopping-submit'])) {
    if(isset($_SESSION['user']['lastname'])) {
        db_execute('INSERT INTO orders (order_id, username, car_id) VALUES (:order_id, :username, :car_id);', [

            ':order_id' => uniqid('', true),
            ':username' => $_SESSION['user']['username'],
            ':car_id' => $_GET['id']

        ]);

        db_execute('UPDATE cars SET is_deleted = :is_deleted WHERE id = :id;', [

            ':is_deleted' => 1,
            ':id' => $_GET['id']

        ]);
    }
}
?>

<?php if(!isset($_SESSION['user']['lastname'])):?>
<table class="table table-dark table-hover table-striped table-borderless table">
    <thead>
    <tr>
        <th scope="col" class="text-center m-auto">Vásárlás előtt kérjük adja meg a szükséges adatokat!<a class="btn btn-primary ms-3 btn-sm" href="?p=mods/set-user-data">Adatok megadása</a></th>
    </tr>
    </thead>
</table>

<?php elseif(isset($_POST['shopping-submit'])): ?>
    <table class="table table-dark table-hover table-striped table-borderless">
        <thead>
        <tr>
            <th scope="col" class="text-center m-auto">Sikeres vásárlás!<a class="btn btn-primary ms-3 btn-sm" href="?p=404">Ok</a></th>
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

    <form method="post">
        <table class="table table-dark table-hover table-striped table-borderless text-center align-middle mx-auto mt-1">
            <thead>
                <tr>
                    <th scope="col" colspan="5" class="text-warning">Rendelni kívánt termék:</th>
                </tr>

                <tr>
                    <th scope="col">Kép</th>
                    <th scope="col">Név</th>
                    <th scope="col">Modell</th>
                    <th scope="col">Szín</th>
                    <th scope="col">Ár</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td scope="row"> <img src="<?= $car['image'] ?>" class="img-fluid rounded mx-auto d-block"  alt=""></td>
                    <td><?= $car['name'] ?></td>
                    <td><?= $car['model'] ?></td>
                    <td><?= $car['colour'] ?></td>
                    <td><?= $car['price'] ?> Ft</td>
                </tr>
            </tbody>

            <tfoot>
                <th scope="row" class="align-middle" colspan="7">
                    <div class="d-grid gap-2">
                        <button type="button" value="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Adatok jóváhagyása és vásárlás</button>
                    </div>
                </th>
            </tfoot>

            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Rendelés</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            A rendeléssel kijelentem, hogy az általam megadott adatok a valóságnak megfelelnek.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vissza</button>
                            <input name ="shopping-submit" type="submit" value="Rendelés" class="btn btn-outline-warning" >
                        </div>
                    </div>
                </div>
            </div>

        </table>
    </form>
<?php endif; ?>

