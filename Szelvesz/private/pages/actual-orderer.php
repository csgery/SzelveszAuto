<?php
$user = db_fetch('users', 'username LIKE :username', [
    ':username' => $_GET['username']
]);
?>

<table class="table table-dark table-hover table-striped table-borderless align-middle mx-auto mt-5 text-center ">
    <thead>
    <tr>
        <th scope="col" colspan="5">Személyes adatok</th>
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
            <th scope="row"> <?= $user['username'] ?> </th>
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
        <th scope="col" colspan="4">Szállítási adatok</th>
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
        <th scope="row"> <?= $user['postal_code'] ?> </th>
        <td><?= $user['city'] ?></td>
        <td><?= $user['street'] ?></td>
        <td><?= $user['house-number'] ?></td>
    </tr>
    </tbody>
</table>