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


<?php if($activeOrder):?>
    <table class="table table-dark table-hover table-striped table-borderless table">
        <thead>
        <tr>
            <th scope="col" class="text-center m-auto">Önnek van aktív rendelése, így nem törölheti a fiókját! <a class="btn btn-primary ms-3 btn-sm" href="?p=my-orders">Értem</a></th>
        </tr>
        </thead>
    </table>
<?php else: ?>
    <table class="table table-dark table-hover table-striped table-borderless table">
        <thead>
        <tr>
            <th scope="col" class="text-center m-auto">Biztos, hogy törölni kívánja fiókját? (A törlés nem vonható vissza!) <a class="btn btn-primary ms-3 btn-sm" href="?p=mods/remove-user-finally">Igen</a><a class="btn btn-primary ms-3 btn-sm" href="?p=home">Nem</a></th>
        </tr>
        </thead>
    </table>
<?php endif; ?>