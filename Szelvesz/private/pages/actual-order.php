<?php
$car = db_fetch('cars', 'id LIKE :car_id', [
    ':car_id' => $_GET['car_id']
]);
?>

<table class="table table-dark table-hover table-striped table-borderless align-middle mx-auto text-center ">
    <thead>
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
            <th scope="row"> <img src="<?= $car['image'] ?>" class="img-fluid rounded mx-auto d-block"  alt=""></th>
            <td><?= $car['name'] ?></td>
            <td><?= $car['model'] ?></td>
            <td><?= $car['colour'] ?></td>
            <td><?= $car['price'] ?> Ft</td>
        </tr>
    </tbody>
</table>
