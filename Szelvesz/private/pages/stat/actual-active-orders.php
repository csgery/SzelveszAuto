<?php

    $user = db_fetch('users', 'username LIKE :username', [
        ':username' => $_GET['username']
    ]);

    $cars = db_fetchall('SELECT * FROM cars INNER JOIN orders ON cars.id = orders.car_id WHERE username = :username AND is_arrived = 0;', [':username'=>$_GET['username']]);

?>


<table class="table table-dark table-hover table-striped table-borderless align-middle mx-auto mt-5 text-center ">
    <thead>
    <tr>
        <th scope="col" colspan="5" class="text-primary">Személyes adatok</th>
    </tr>
    <tr>
        <th scope="col">Felhasználónév</th>
        <th scope="col">Vezetéknév</th>
        <th scope="col">Keresztnév</th>
        <th scope="col">Email</th>
        <th scope="col">Telefonszám</th>

    </tr>
    </thead>

    <tbody>


    <tr>
        <td scope="row"> <?= $user['username'] ?> </td>
        <td><?= $user['lastname'] ?></td>
        <td><?= $user['firstname'] ?></td>
        <td><?= $user['email'] ?></td>
        <td><?= $user['phone_number'] ?></td>
    </tr>

    </tbody>

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

</table>

<table class="table table-dark table-hover table-striped table-borderless align-middle mx-auto mt-5 mb-4 text-center ">
    <thead>
    <tr>
        <th colspan="6" class="text-primary">Rendelt autó adatai</th>
    </tr>
    <tr>
        <th></th>
        <th scope="col">Kép</th>
        <th scope="col">Név</th>
        <th scope="col">Modell</th>
        <th scope="col">Szín</th>
        <th scope="col">Ár</th>
    </tr>
    </thead>

    <tbody>

    <?php $counter = 1; ?>
    <?php foreach($cars as $car):?>
        <tr>
            <th scope="row"><?= $counter?>.</th>
            <td> <img src="<?= $car['image'] ?>" class="img-fluid rounded mx-auto d-block"  alt=""></td>
            <td><?= $car['name'] ?></td>
            <td><?= $car['model'] ?></td>
            <td><?= $car['colour'] ?></td>
            <td><?= $car['price'] ?> Ft</td>
        </tr>
        <?php $counter++; ?>
    <?php endforeach;?>





    </tbody>

</table>
