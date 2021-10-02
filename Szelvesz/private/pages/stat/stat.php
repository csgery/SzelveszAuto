<?php


?>


<table class="table table-dark table-hover table-striped table-borderless align-middle mx-auto mt-5 text-center ">
    <?php $usersCount = db_fetchall('SELECT count(username) FROM users') ?>
    <thead>
    <tr>
        <th scope="col" colspan="9" class="text-primary">Felhasználói statisztika</th>
    </tr>
    <?php if($usersCount[0]["count(username)"] < 2):?>
        <tr>
            <th>Jelenleg nincs regisztrált felhasználó, csak Ön!</th>
        </tr>

    <?php else:?>
        <tr>
            <th scope="col">Regisztrált fiókok száma</th>
            <th scope="col">Ebből vásárlók száma</th>
            <th scope="col">Ebből alkalmazottak száma</th>
            <th scope="col">Ebből adminisztrátorok száma</th>
        </tr>
        </thead>


        <tbody>
            <tr>
                <td scope="row"><?= $usersCount[0]["count(username)"];?></td>
                <td><?= db_fetchall('SELECT count(username) FROM users WHERE auth = 2')[0]["count(username)"];?></td>
                <td><?= db_fetchall('SELECT count(username) FROM users WHERE auth = 1')[0]["count(username)"];?></td>
                <td><?= db_fetchall('SELECT count(username) FROM users WHERE auth = 0')[0]["count(username)"];?></td>
            </tr>
        </tbody>
    <?php endif;?>
</table>

<table class="table table-dark table-hover table-striped table-borderless align-middle mx-auto mt-1 text-center ">


    <thead>
    <tr>
        <th scope="col" colspan="9" class="text-primary">Rendelési statisztika</th>
    </tr>
    <tr>
        <?php $activeOrderCount = db_fetchall('SELECT count(order_id) FROM orders WHERE is_arrived = 0'); ?>
        <?php if($activeOrderCount[0]["count(order_id)"] < 1):?>
            <th scope="col">Jelenleg nincs aktív rendelés!</th>
        <?php else:?>
            <th scope="col">Aktív rendelések száma</th>
            <th scope="col">Ebből megerősítésre vár</th>
            <th scope="col">Ebből előkészítés alatt</th>
            <th scope="col">Ebből szállítás alatt</th>
            <th scope="col">Mindenkori teljesített rendelések száma</th>
    </tr>
    </thead>




    <tbody>
    <tr>
        <td scope="row"><?= $activeOrderCount[0]["count(order_id)"];?></td>
        <td><?= db_fetchall('SELECT count(order_id) FROM orders WHERE preparing = 0 AND is_arrived = 0')[0]["count(order_id)"];?></td>
        <td><?= db_fetchall('SELECT count(order_id) FROM orders WHERE preparing = 1 AND is_shipped = 0 AND is_arrived = 0')[0]["count(order_id)"];?></td>
        <td><?= db_fetchall('SELECT count(order_id) FROM orders WHERE is_shipped = 1 AND is_arrived = 0')[0]["count(order_id)"];?></td>
        <td><?= db_fetchall('SELECT count(order_id) FROM orders WHERE is_arrived = 1')[0]["count(order_id)"];?></td>
    </tr>


    </tbody>
        <?php endif;?>
</table>

<table class="table table-dark table-hover table-striped table-borderless align-middle mx-auto mt-1 text-center ">

    <thead>
    <?php $orderers = db_fetchall('SELECT distinct(username) FROM orders'); ?>
        <tr>
            <th scope="col" colspan="9" class="text-primary">Rendelések</th>
        </tr>
    <?php if($orderers[0] < 1):?>
        <tr>
            <th scope="col" colspan="9" class="text-center justify-content-center">Jelenleg nincsenek rendelések!</th>
        </tr>
    <?php else:?>
        <tr>
            <th scope="col"></th>
            <th scope="col">Megrendelő felhasználóneve</th>
            <th scope="col">Megrendelő email címe</th>
            <th scope="col">Aktív rendelései</th>
            <th scope="col">Aktív rendeléseinek ára (Ft)</th>
            <th scope="col">Passzív rendelései</th>
            <th scope="col">Passzív rendeléseinek ára (Ft)</th>
        </tr>
    <?php endif;?>
    </thead>


    <tbody>
    <?php $counter = 1; ?>
    <?php foreach ($orderers as $orderer):?>
        <?php $activeOrderCount = db_fetchall('SELECT count(order_id) FROM orders WHERE username LIKE :username AND is_arrived = 0', ['username' => $orderer['username']]); ?>
        <?php $activeOrderPrice = db_fetchall('SELECT sum(price) FROM cars INNER JOIN orders ON orders.car_id = cars.id WHERE username = :username AND is_arrived =0 ', [':username'=> $orderer['username']]); ?>
        <?php $passiveOrderCount = db_fetchall('SELECT count(order_id) FROM orders WHERE username LIKE :username AND is_arrived = 1', ['username' => $orderer['username']]) ?>
        <?php $passiveOrderPrice = db_fetchall('SELECT sum(price) FROM cars INNER JOIN orders ON orders.car_id = cars.id WHERE username = :username AND is_arrived =1 ', [':username'=> $orderer['username']]); ?>
       <tr>
            <th scope="row"><?= $counter ?>.</th>
            <td><?= $orderer['username'];?></td>

            <td><?= db_fetch_single('email','users', 'username LIKE :username', [':username' => $orderer['username']])['email'];?></td>

            <?php if($activeOrderCount[0]['count(order_id)'] < 1):?>
                <td>0</td>
            <?php else: ?>
                <td><a href="?p=stat/actual-active-orders&username=<?= $orderer['username'] ?>" class="text-decoration-none link-info"><?= $activeOrderCount [0]["count(order_id)"];?></a></td>
            <?php endif;?>

            <?php if(strlen($activeOrderPrice[0]['sum(price)']) < 1): ?>
                <td>0</td>
            <?php else: ?>
                <td><?= $activeOrderPrice[0]['sum(price)'];?></td>
            <?php endif;?>

            <?php if($passiveOrderCount[0]['count(order_id)'] < 1):?>
                <td>0</td>
            <?php else: ?>
                <td><a href="?p=stat/actual-passive-orders&username=<?= $orderer['username'] ?>" class="text-decoration-none link-info"><?= $passiveOrderCount [0]["count(order_id)"];?></a></td>
            <?php endif;?>

            <?php if(strlen($passiveOrderPrice[0]['sum(price)']) < 1): ?>
                <td>0</td>
            <?php else: ?>
                <td><?= $passiveOrderPrice[0]['sum(price)'];?></td>
            <?php endif;?>
        </tr>
        <?php $counter ++; ?>
    <?php endforeach;?>


    </tbody>


</table>