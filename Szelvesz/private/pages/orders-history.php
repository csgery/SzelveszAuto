<?php



$passiveOrders = db_fetchall('SELECT * FROM orders WHERE is_arrived = 1;');

if(isset($_POST['submit'])) {

    if($_POST['reset_order']){
        foreach ($_POST['reset_order']['order_id'] as $order_id => $value){
            db_execute('UPDATE orders SET preparing = 0, is_shipped = 0, is_arrived = 0 WHERE order_id = :order_id', [':order_id' => $order_id]);

        }
    }



}


?>



<?php if(!isset($_POST['submit'])): ?>
    <?php if(!empty($passiveOrders)): ?>
        <form method="post" >
        <table class="table table-dark table-hover table-striped table-borderless align-middle mx-auto mt-3 text-center ">

        <thead>
        <tr>
            <th scope="col" colspan="9" class="text-primary">Teljesített rendelések</th>
        </tr>
        <tr>
            <th scope="col" ></th>
            <th scope="col">Rendelési azonosító</th>
            <th scope="col">Megrendelő neve</th>
            <th scope="col">Rendelés ára (Ft)</th>
            <th scope="col">Rendelés ideje</th>
            <th scope="col">Kézbesítés ideje</th>
            <?php if($_SESSION['user']['auth'] == 0): ?>
                <th scope="col">Rendelés nullázása</th>
            <?php endif; ?>
        </tr>
        </thead>

        <tbody>

        <?php $counter = 1; ?>
        <?php foreach($passiveOrders as $passiveOrder): ?>
            <?php $user = db_fetch('users', 'username LIKE :username', [':username' => $passiveOrder['username']]);?>
            <?php $car = db_fetch('cars', 'id LIKE :car_id', [':car_id' => $passiveOrder['car_id']]);?>
            <tr>
                <th><?= $counter?>.</th>
                <td><a href="?p=actual-order&car_id=<?= $passiveOrder['car_id']?>" class="text-decoration-none"><?= $passiveOrder['order_id'] ?></a></td>
                <td class="align-middle"><a href="?p=actual-orderer&username=<?= $user['username'] ?>" class="text-decoration-none"><?= $user['lastname'] . ' ' . $user['firstname'] ?></a></td>
                <td class="align-middle"><?= $car['price'] ?></td>
                <td class="align-middle"><?= $passiveOrder['order_date'] ?></td>
                <td class="align-middle"><?= $passiveOrder['arrived_at'] ?></td>
                <?php if($_SESSION['user']['auth'] == 0): ?>
                    <td>
                        <div class="form check checkbox-inline">
                            <input class="form-check-input " type="checkbox" name="reset_order[order_id][<?=$passiveOrder['order_id'] ?>]" value="1" id="flexCheckDefault">
                        </div>
                    </td>
                <?php endif; ?>
            </tr>
            <?php $counter++; ?>
        <?php endforeach; ?>


        </tbody>
            <?php if ($_SESSION['user']['auth'] == 0):?>

                <tfoot>
                <th scope="row" class="align-middle" colspan="10">
                    <div class="d-grid gap-2">
                        <button type="button" value="" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Változások mentése</button>
                    </div>
                </th>
                </tfoot>

                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Mentés</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Módosításokat készül végrehajtani. Biztos benne?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vissza</button>
                                <input name ="submit" type="submit" value="Mentés" class="btn btn-outline-danger" >
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif;?>

        
        </table>
        </form>
    

<?php elseif(count(($_POST)) == 1):?>
    <table class="table table-dark table-hover table-striped table-borderless table">
        <thead>
        <tr>
            <th scope="col" class="text-center m-auto">Nem történt módosítás! <a class="btn btn-primary ms-3 btn-sm" href="?p=orders-history">Ok</a>
        </tr>
        </thead>
    </table>
<?php elseif(count(($_POST)) > 1): ?>
    <table class="table table-dark table-hover table-striped table-borderless table">
        <thead>
        <tr>
            <th scope="col" class="text-center m-auto">A módosítás sikeresen végbement! <a class="btn btn-primary ms-3 btn-sm" href="?p=orders-history">Ok</a>
        </tr>
        </thead>
    </table>
<?php endif; ?>