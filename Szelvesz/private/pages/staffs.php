<?php

$staffs = db_fetchall('SELECT * FROM users WHERE auth=1');



?>

<table class="table table-dark table-hover table-striped table-borderless">

    <thead>
    <tr class="align-middle mx-auto text-center">
        <?php if(!$staffs): ?>
            <th scope="col">Nincsenek alkalamzottak</th>

        <?php else: ?>
            <th scope="col">Felhasználónév</th>
            <th scope="col">Email</th>
            <th scope="col"></th>

        <?php endif; ?>
    </tr>
    </thead>

    <tbody>


    <?php if($staffs): ?>
        <?php foreach($staffs as $staff): ?>
            <tr class="align-middle mx-auto text-center">
                <th scope="row" class="align-middle"><?= $staff['username'] ?></th>
                <td class="align-middle"><?= $staff['email'] ?></td>
                <td><a href="?p=mods/remove-staff&username=<?= $staff['username']?>" class="text-decoration-none">Elbocsátás</a></td>
            </tr>

        <?php endforeach; ?>
    <?php endif; ?>


    </tbody>

    <tfoot>

    <th scope="row" class="align-middle mx-auto text-center" colspan="5"><a href="?p=mods/add-staff" class="text-decoration-none">Új személy hozzáadása</a></th>

    </tfoot>
</table>


