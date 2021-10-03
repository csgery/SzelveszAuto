<?php

function validate_car_reg(array $request): array{
    $error = [];

    if(empty($request['name'])){
        $error['name'][] = 'Autó neve nem lehet üres!';
    }else if(strlen($request['name']) < 2) {
        $error['name'][] = 'Autó neve legalább 2 karakter!';
    }

    if(empty($request['model'])){
        $error['model'][] = 'Autó modell nem lehet üres!';
    }

    if(empty($request['colour'])){
        $error['colour'][] = 'Autó színe nem lehet üres!';
    }
    

    if(empty($request['price'])){
        $error['price'][] = 'Autó ára nem lehet üres!';
    }elseif($request['price'] < 1){
        $error['price'][] = 'Autó ára nem lehet kisebb, mint 1!';
    }elseif($request['price'] > 2_100_000_000){
        $error['price'][] = 'Autó ára nem lehet nagyobb, mint 2,1 milliárd!';
    }


    $carInDB = db_fetch('cars', 'name LIKE :name AND model LIKE :model AND colour LIKE :colour AND price LIKE :price AND is_deleted = 0', [
        ':name' => $_POST['name'],
        ':model' => $_POST['model'],
        ':colour' => $_POST['colour'],
        ':price' => $_POST['price']
    ]);

    if($carInDB){
        $error['notUnique'][] = 'Ez az autó már fel van töltve!';
    }


    return $error;
}

function validate_car_edit(array $request): array{
    $error = [];

    if(!empty($request['name'])){

        if(strlen($request['name']) < 2) {
            $error['name'][] = 'Autó neve legalább 2 karakter!';
        }
    }

    if(!empty($request['price'])) {

        if ($request['price'] < 1) {
            $error['price'][] = 'Autó ára nem lehet kisebb, mint 1!';
        } elseif ($request['price'] > 2_100_000_000) {
            $error['price'][] = 'Autó ára nem lehet nagyobb, mint 2,1 milliárd!';
        }
    }



    return $error;
}