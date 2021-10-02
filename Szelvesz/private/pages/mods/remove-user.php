<?php
$orders = db_fetchall('SELECT * FROM orders WHERE username LIKE :username', [':username' => $_SESSION['user']['username']]);
$activeOrder = null;

if(!empty($orders))
    foreach ($orders as $order){
        if($order['is_arrived'] == 0){
            $activeOrder = true;
            break;
        }
    }
else{
    $activeOrder = false;
}

?>

