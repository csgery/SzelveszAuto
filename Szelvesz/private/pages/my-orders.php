<?php
$myActiveOrders = db_fetchall('SELECT * FROM orders WHERE username LIKE :username AND is_arrived = 0;', [
        ':username' => $_SESSION['user']['username']
]);

$myPassiveOrders = db_fetchall('SELECT * FROM orders WHERE username LIKE :username AND is_arrived = 1;', [
    ':username' => $_SESSION['user']['username']
]);
?>

<table class="table table-dark table-hover table-striped table-borderless align-middle mx-auto mt-5 text-center ">
    <?php if($myActiveOrders != null): ?>
        <thead>
        <tr>
            <th scope="col" colspan="9" class="text-primary">Aktív rendeléseim</th>
        </tr>
        <tr>
            <th></th>
            <th scope="col">Kép</th>
            <th scope="col">Rendelési azonosító</th>
            <th scope="col">Rendelés ideje</th>
            <th scope="col">Név</th>
            <th scope="col">Modell</th>
            <th scope="col">Szín</th>
            <th scope="col">Ár (Ft)</th>
            <th scope="col">Rendelés státusza</th>
        </tr>
        </thead>
    <?php else: ?>
        <thead>
            <tr>
                <th scope="col">Önnek jelenleg nincs aktív rendelése!</th>
            </tr>
        </thead>

    <?php endif; ?>

    <tbody>

        <?php $counter = 1; ?>
        <?php foreach($myActiveOrders as $myOrder): ?>
            <?php $car = db_fetch('cars', 'id LIKE :car_id', [':car_id' => $myOrder['car_id']]);?>
            <tr>
                <th scope="row"><?= $counter?>.</th>
                <td> <img src="<?= $car['image'] ?>" class="img-fluid rounded mx-auto d-block"  alt=""></td>
                <td><?= $myOrder['order_id']?></td>
                <td><?= $myOrder['order_date']?></td>
                <td><?= $car['name'] ?></td>
                <td><?= $car['model'] ?></td>
                <td><?= $car['colour'] ?></td>
                <td><?= $car['price'] ?></td>

                <?php if($myOrder['is_arrived'] == 1): ?>
                    <td>Rendelése kiszállítva a megadott címre</td>

                <?php elseif($myOrder['preparing'] && $myOrder['is_shipped']): ?>
                    <td>Rendelése szállítás alatt</td>

                <?php elseif($myOrder['preparing']): ?>
                    <td>Rendelése jóváhagyva, elkészítés alatt</td>

                <?php elseif(!$myOrder['preparing']): ?>
                    <td>Rendelése eladói jóváhagyásra vár</td>

                <?php else: ?>
                    <td>Hiba lépett fel a rendelése kezelése során, kérjük vegye fel a kapcsolatot a tulajdonossal!</td>

                <?php endif; ?>

            </tr>
            <?php $counter++; ?>
        <?php endforeach; ?>
    </tbody>

    <tfoot>
        <th scope="row" colspan="9"><a href="?p=cars" class="text-decoration-none">Új autó vásárlása</a></th>
    </tfoot>
</table>