<?php

    $user = db_fetch('users', 'username LIKE :username', [
        ':username' => $_GET['username']
    ]);

    $cars = db_fetchall('SELECT * FROM cars INNER JOIN orders ON cars.id = orders.car_id WHERE username = :username AND is_arrived = 0;', [':username'=>$_GET['username']]);

?>