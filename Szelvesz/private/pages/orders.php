<?php


$orders = db_fetchAll('SELECT * FROM orders WHERE is_arrived = 0;');


if(isset($_POST['submit'])){
    if($_POST['preparing']){
        foreach ($_POST['preparing']['order_id'] as $order_id => $value){
            db_execute('UPDATE orders SET preparing = :preparing WHERE order_id = :order_id;', [
                    ':preparing' => $value,
                    ':order_id' => $order_id
            ]);

        }

    }

    if($_POST['is_shipped']){
        foreach ($_POST['is_shipped']['order_id'] as $order_id => $value){
            db_execute('UPDATE orders SET is_shipped = :is_shipped, preparing = :preparing WHERE order_id = :order_id;', [
                ':is_shipped' => $value,
                ':preparing' => $value,
                ':order_id' => $order_id
            ]);

        }

    }

    if($_POST['is_arrived']){
        foreach ($_POST['is_arrived']['order_id'] as $order_id => $value){
            db_execute('UPDATE orders SET arrived_at = :arrived_at, is_arrived = :is_arrived, is_shipped = :is_shipped, preparing = :preparing WHERE order_id = :order_id;', [
                'arrived_at' => date("Y-m-d H:i:s"),
                ':is_arrived' => $value,
                ':is_shipped' => $value,
                ':preparing' => $value,
                ':order_id' => $order_id
            ]);

        }

    }


    if($_POST['reset_order']){
        foreach ($_POST['reset_order']['order_id'] as $order_id => $value){
            db_execute('UPDATE orders SET preparing = 0, is_shipped = 0 WHERE order_id = :order_id', [':order_id' => $order_id]);

        }
    }



    if($_POST['delete_order']){
        foreach ($_POST['delete_order']['order_id'] as $order_id => $value){
            db_execute('UPDATE cars SET is_deleted = 0 WHERE cars.id = (SELECT car_id FROM orders WHERE order_id = :order_id)', [':order_id' => $order_id]);
            db_execute('DELETE FROM orders WHERE order_id = :order_id', [':order_id' => $order_id]);



        }
    }





}



?>




<?php if(!isset($_POST['submit'])): ?>
    <?php if(!empty($orders)): ?>
    <form method="post" >
    <table class="table table-dark table-hover table-striped table-borderless align-middle mx-auto mt-3 text-center">

        <thead>

        <tr class="align-middle mx-auto text-center">
            <th scope="col" colspan="10" class="text-primary">Akt??v rendel??sek</th>
        </tr>

        <tr class="align-middle mx-auto text-center sticky-top ">
            <th scope="col" ></th>
            <th scope="col">Rendel??si azonos??t??</th>
            <th scope="col">Megrendel?? neve</th>
            <th scope="col">Rendel??s ??ra (Ft)</th>
            <th scope="col">Rendel??s ideje</th>
            <th scope="col">Elk??sz??t??s alatt</th>
            <th scope="col">Sz??ll??t??s alatt</th>
            <th scope="col">K??zbes??tve</th>
            <?php if($_SESSION['user']['auth'] == 0): ?>
                <th scope="col">Rendel??s vissza??ll??t??sa</th>
                <th scope="col">Rendel??s t??rl??se</th>
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
                    <th scope="col" class="text-end m-auto" colspan="10"><a class="btn btn-primary ms-3 btn-sm" href="./active-orders-export.php">Rendel??sek let??lt??se</a></th>
                </div>
            </tr>
        </tbody>
        <tfoot>
            <th scope="row" class="align-middle" colspan="10">
                <div class="d-grid gap-2">
                    <button type="button" value="" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">V??ltoz??sok ment??se</button>
                </div>
            </th>
        </tfoot>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Ment??s</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        A m??dos??t??sok nem vonhat??ak vissza! Biztos benne?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vissza</button>
                        <input name ="submit" type="submit" value="Ment??s" class="btn btn-outline-danger" >
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
                <th scope="col" class="text-center m-auto">Jelenleg nincs akt??v rendel??s!</th>
            </tr>
            </thead>
        </table>
    <?php endif; ?>
    <table class="table table-dark table-hover table-striped table-borderless align-middle mx-auto mt-0 text-center">

        <thead>
            <tr class="align-middle mx-auto text-center">
                <th scope="col" ><a href="?p=orders-history" class="text-decoration-none">Rendel??si el??zm??nyek</a></th>
            </tr>
        </thead>
    </table>



<?php elseif(count(($_POST)) == 1):?>
    <table class="table table-dark table-hover table-striped table-borderless table">
        <thead>
        <tr>
            <th scope="col" class="text-center m-auto">Nem t??rt??nt m??dos??t??s! <a class="btn btn-primary ms-3 btn-sm" href="?p=orders">Ok</a>
        </tr>
        </thead>
    </table>
<?php elseif(count(($_POST)) > 1): ?>
    <table class="table table-dark table-hover table-striped table-borderless table">
        <thead>
        <tr>
            <th scope="col" class="text-center m-auto">A m??dos??t??s sikeresen v??gbement! <a class="btn btn-primary ms-3 btn-sm" href="?p=orders">Ok</a>
        </tr>
        </thead>
    </table>


<?php endif; ?>