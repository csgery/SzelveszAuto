<?php


$cars = db_fetchall('SELECT * FROM cars ORDER BY name');
?>


<?php if(!empty($cars)): ?>
    <table class="table table-dark table-hover table-striped table-borderless align-middle mx-auto mt-3 text-center ">
        <thead>
        <tr>
            <th scope="col" colspan="8" class="text-primary">Eladó autók</th>
        </tr>
        <tr>
            <th scope="col"></th>
            <th scope="col">Kép</th>
            <th scope="col">Név</th>
            <th scope="col">Modell</th>
            <th scope="col">Szín</th>
            <th scope="col">Ár (Ft)</th>
            <?php if($_SESSION['user']['auth'] === 2): ?>
                <th scope="col"></th>
            <?php elseif(!isset($_SESSION['user'])): ?>
                <th scope="col"></th>
            <?php endif; ?>
            <?php if($_SESSION['user']['auth'] === 0):?>
                <th scope="col"></th>
                <th scope="col"></th>
            <?php endif; ?>
        </tr>
        </thead>

        <tbody>


            <?php $counter = 1; ?>
            <?php foreach($cars as $car): ?>
                <?php if($car['is_deleted'] != 1): ?>
                    <tr>
                        <th scope="row"><?= $counter?>.</th>
                        <td><img src="<?= $car['image'] ?>" class="img-fluid rounded mx-auto d-block"  alt=""></td>
                        <td><?= $car['name'] ?></td>
                        <td><?= $car['model'] ?></td>
                        <td><?= $car['colour'] ?></td>
                        <td><?= $car['price'] ?></td>
                        <?php if($_SESSION['user']['auth'] === 2): ?>
                            <td><a href="?p=buy&id=<?= $car['id'] ?>" class="text-decoration-none">Megvásárlás</a> </td>
                        <?php elseif(!isset($_SESSION['user'])): ?>
                            <td>Vásárláshoz kérjük <a href="?p=auth/registration" class="text-decoration-none">regisztráljon</a>/<a href="?p=auth/login" class="text-decoration-none">jelentkezzen be!</a></td>
                        <?php endif; ?>
                        <?php if($_SESSION['user']['auth'] === 0):?>
                            <td><a href="?p=mods/edit-car&id=<?= $car['id']?>" class="text-decoration-none">Szerkesztés</a></td>
                            <td><a href="?p=mods/remove-car&id=<?= $car['id']?>" class="text-decoration-none">Törlés</a></td>
                        <?php endif; ?>
                    </tr>
                <?php $counter++; ?>
                <?php endif; ?>
            <?php endforeach; ?>



        </tbody>

        

    </table>

<?php endif; ?>