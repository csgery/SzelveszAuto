<?php
    $orders = db_fetchAll('SELECT * FROM orders WHERE is_arrived = 0;');
?>

    <form method="post" >
    <table class="table table-dark table-hover table-striped table-borderless align-middle mx-auto mt-3 text-center">

        <thead>

        <tr class="align-middle mx-auto text-center">
            <th scope="col" colspan="10" class="text-primary">Aktív rendelések</th>
        </tr>

        <tr class="align-middle mx-auto text-center sticky-top ">
            <th scope="col" ></th>
            <th scope="col">Rendelési azonosító</th>
            <th scope="col">Megrendelő neve</th>
            <th scope="col">Rendelés ára (Ft)</th>
            <th scope="col">Rendelés ideje</th>
            <th scope="col">Elkészítés alatt</th>
            <th scope="col">Szállítás alatt</th>
            <th scope="col">Kézbesítve</th>
            <?php if($_SESSION['user']['auth'] == 0): ?>
                <th scope="col">Rendelés visszaállítása</th>
                <th scope="col">Rendelés törlése</th>
            <?php endif; ?>

        </tr>
        </thead>
        <tbody>

            <?php $counter = 1; ?>
            <?php foreach ($orders as $order): ?>
                <?php $user = db_fetch('users', 'username LIKE :username', [':username' => $order['username']]);?>
                <?php $car = db_fetch('cars', 'id LIKE :car_id', [':car_id' => $order['car_id']]);?>
                    <tr>
                        <th><?= $counter?>.</th>
                        <td><a href="?p=actual-order&car_id=<?= $order['car_id']?>" class="text-decoration-none"><?= $order['order_id'] ?></a></td>
                        <td class="align-middle"><a href="?p=actual-orderer&username=<?= $user['username'] ?>" class="text-decoration-none"><?= $user['lastname'] . ' ' . $user['firstname'] ?></a></td>
                        <td class="align-middle"><?= $car['price'] ?></td>
                        <td class="align-middle"><?= $order['order_date'] ?></td>
                        <?php if(!$order['preparing']):?>
                            <td >
                                <div class="form check checkbox-inline">
                                    <input class="form-check-input" type="checkbox" name="preparing[order_id][<?=$order['order_id'] ?>]" value="1" id="flexCheckDefault">
                                </div>
                            </td>
                        <?php else:?>
                            <td>
                                <div class="form check checkbox-inline">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked disabled>
                                </div>
                            </td>

                        <?php endif;?>

                        <?php if(!$order['is_shipped']): ?>
                            <td>
                                <div class="form check checkbox-inline">
                                    <input class="form-check-input " type="checkbox" name="is_shipped[order_id][<?=$order['order_id'] ?>]" value="1" id="flexCheckDefault">
                                </div>
                            </td>

                        <?php else:?>
                            <td>
                                <div class="form check checkbox-inline">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked disabled>
                                </div>
                            </td>

                        <?php endif;?>

                        <?php if(!$order['is_arrived']): ?>
                            <td >
                                <div class="form check checkbox-inline">
                                    <input class="form-check-input" type="checkbox" name="is_arrived[order_id][<?=$order['order_id'] ?>]" value="1" id="flexCheckDefault">
                                </div>
                            </td>

                        <?php else:?>
                            <td>
                                <div class="form check checkbox-inline">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked disabled>
                                </div>
                            </td>


                        <?php endif;?>

                        <?php if($_SESSION['user']['auth'] == 0): ?>
                            <td>
                                <div class="form check checkbox-inline">
                                    <input class="form-check-input" type="checkbox" name="reset_order[order_id][<?=$order['order_id'] ?>]" value="1" id="flexCheckDefault">
                                </div>
                            </td>

                            <td>
                                <div class="form check checkbox-inline">
                                    <input class="form-check-input" type="checkbox" name="delete_order[order_id][<?=$order['order_id'] ?>]" value="1" id="flexCheckDefault">
                                </div>
                            </td>
                        <?php endif; ?>


                    </tr>
                <?php $counter++; ?>
            <?php endforeach; ?>

            <tr>
                <div class="d-grid gap-2">
                    <th scope="col" class="text-end m-auto" colspan="10"><a class="btn btn-primary ms-3 btn-sm" href="./active-orders-export.php">Rendelések letöltése</a></th>
                </div>
            </tr>
        </tbody>
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
                        A módosítások nem vonhatóak vissza! Biztos benne?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vissza</button>
                        <input name ="submit" type="submit" value="Mentés" class="btn btn-outline-danger" >
                    </div>
                </div>
            </div>
        </div>
    </table>
    </form>
    <?php else: ?>

        <table class="table table-dark table-hover table-striped table-borderless table">
            <thead>
            <tr>
                <th scope="col" class="text-center m-auto">Jelenleg nincs aktív rendelés!</th>
            </tr>
            </thead>
        </table>
    <?php endif; ?>
    <table class="table table-dark table-hover table-striped table-borderless align-middle mx-auto mt-0 text-center">

        <thead>
            <tr class="align-middle mx-auto text-center">
                <th scope="col" ><a href="?p=orders-history" class="text-decoration-none">Rendelési előzmények</a></th>
            </tr>
        </thead>
    </table>



<?php elseif(count(($_POST)) == 1):?>
    <table class="table table-dark table-hover table-striped table-borderless table">
        <thead>
        <tr>
            <th scope="col" class="text-center m-auto">Nem történt módosítás! <a class="btn btn-primary ms-3 btn-sm" href="?p=orders">Ok</a>
        </tr>
        </thead>
    </table>
<?php elseif(count(($_POST)) > 1): ?>
    <table class="table table-dark table-hover table-striped table-borderless table">
        <thead>
        <tr>
            <th scope="col" class="text-center m-auto">A módosítás sikeresen végbement! <a class="btn btn-primary ms-3 btn-sm" href="?p=orders">Ok</a>
        </tr>
        </thead>
    </table>


<?php endif; ?>