<?php

function validate_user_reg(array $request): array{

    $error = [];

    if(empty($request['username'])){
        $error['username'][] = 'A felhasználónév nem lehet üres!';
    }else if(strlen($request['username']) < 6) {
        $error['username'][] = 'A felhasználónév legalább 6 karakter!';
    }else {
        $username = db_fetch('users', 'username LIKE :username', [
            ':username' => $request['username']]);
        if($username){
            $error['username'][] = 'Ez a felhasználónév már foglalt!';
        }
    }

    if(empty($request['email'])){
        $error['email'][] = "Az email nem lehet üres!";
    }else if (preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', ($request['email']))) {
        $error['email'][] = "Az email nem tartalmazhat speciális karaktert! ('/[\'^£$%&*()}{#~?><>,|=_+¬-]/')";
    }else{
        $email = db_fetch('users','email LIKE :email', [
            ':email' => $request['email']]);
        if($email){
            $error['email'][]= "Ez az email már foglalt!";
        }
    }


    if(empty($request['password'])){
        $error['password'][] = 'A jelszó nem lehet üres!';
    }else if(strlen($request['password']) < 8) {
        $error['password'][] = 'A jelszó legalább 8 karakter!';
    }else if ($request['password'] !== $request['password_confirmation']) {
        $error['password_confirmation'][] = 'A jelszó és a megerősítése nem egyezik!';
    }

    
    return $error;
}

function validate_staff_reg(array $request): array{

    $error = [];

    if(empty($request['username'])){
        $error['username'][] = 'A felhasználónév nem lehet üres!';
    }else if(strlen($request['username']) < 3) {
        $error['username'][] = 'A felhasználónév legalább 3 karakter!';
    }else {
        $username = db_fetch('users', 'username LIKE :username', [
            ':username' => $request['username']]);
        if($username){
            $error['username'][] = 'Ez a felhasználónév már foglalt!';
        }
    }

    if(empty($request['email'])){
        $error['email'][] = "Az email nem lehet üres!";
    }else if (preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', ($request['email']))) {
        $error['email'][] = "Az email nem tartalmazhat speciális karaktert! ('/[\'^£$%&*()}{#~?><>,|=_+¬-]/')";
    }else{
        $email = db_fetch('users','email LIKE :email', [
            ':email' => $request['email']]);
        if($email){
            $error['email'][]= "Ez az email már foglalt!";
        }
    }


    if(empty($request['password'])){
        $error['password'][] = 'A jelszó nem lehet üres!';
    }else if(strlen($request['password']) < 8) {
        $error['password'][] = 'A jelszó legalább 8 karakter!';
    }else if ($request['password'] !== $request['password_confirmation']) {
        $error['password_confirmation'][] = 'A jelszó és a megerősítése nem egyezik!';
    }


    return $error;
}

function validate_user_login_edit(array $request): array{

    $error = [];

    if(!empty($request['username'])){

        if(strlen($request['username']) < 6) {
            $error['username'][] = 'A felhasználónév legalább 6 karakter!';
        }else {

            $username = db_fetch('users', 'username LIKE :username', [
                ':username' => $request['username']]);
            if($username){
                $error['username'][] = 'Ez a felhasználónév már foglalt!';
            }
        }

    }

    if(!empty($request['email'])) {

        if (preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', ($request['email']))) {
            $error['email'][] = "Az email nem tartalmazhat speciális karaktert! ('/[\'^£$%&*()}{#~?><>,|=_+¬-]/')";
        }else {
            $email = db_fetch('users', 'email LIKE :email', [
                ':email' => $request['email']]);
            if ($email) {
                $error['email'][] = "Ez az email már foglalt!";
            }
        }
    }


    if(!empty($request['password'])) {

        if (strlen($request['password']) < 8) {
            $error['password'][] = 'A jelszó legalább 8 karakter!';
        } else if ($request['password'] !== $request['password_confirmation']) {
            $error['password_confirmation'][] = 'A jelszó és a megerősítése nem egyezik!';
        }
    }


    return $error;
}

function validate_user_personal_data(array $request, bool $firstSet) :array
{

    $error = [];


    if ($firstSet) {
        if (empty($request['lastname'])) {
            $error['lastname'][] = 'A vezetéknév nem lehet üres!';
        } else if (strlen($request['lastname']) < 2) {
            $error['lastname'][] = 'A vezetéknév legalább 2 karakter!';
        }
    } else if (!empty($request['lastname'])) {

        if (strlen($request['lastname']) < 2) {
            $error['lastname'][] = 'A vezetéknév legalább 2 karakter!';
        }
    }


    if ($firstSet) {
        if (empty($request['firstname'])) {
            $error['firstname'][] = 'A keresztnév nem lehet üres!';
        } else if (strlen($request['firstname']) < 2) {
            $error['firstname'][] = 'A keresztnév legalább 2 karakter!';
        }
    } else if (!empty($request['firstname'])) {

        if (strlen($request['firstname']) < 2) {
            $error['firstname'][] = 'A keresztnév legalább 2 karakter!';
        }
    }


    if (!empty($request['email'])) {
        $email = db_fetch('users', 'email LIKE :email', [
            ':email' => $request['email']
        ]);
        if ($email) {
            $error['email'][] = 'Ez az email már foglalt!';
        }
    }


    if ($firstSet) {
        if (empty($request['phone_number'])) {
            $error['phone_number'][] = 'A telefonszám nem lehet üres!';
        } else if (strlen($request['phone_number']) < 11) {
            $error['phone_number'][] = 'A telefonszám legalább 11 karakter!';
        }
    } else if (!empty($request['phone_number'])) {

        if (strlen($request['phone_number']) < 11) {
            $error['phone_number'][] = 'A telefonszám legalább 11 karakter!';
        } else {
            $phone_number = db_fetch('users', 'phone_number LIKE :phone_number', [
                ':phone_number' => $request['phone_number']]);
            if ($phone_number) {
                $error['phone_number'][] = 'Ez a telefonszám már foglalt!';
            }
        }
    }


    return $error;

}


function validate_user_shipping_data(array $request, bool $firstSet) :array{


    $error = [];

    if ($firstSet) {
        if (empty($request['postal_code'])) {
            $error['postal_code'][] = 'Az irányítószám nem lehet üres!';
        } else if (strlen($request['postal_code']) < 4) {
            $error['postal_code'][] = 'Az irányítószám legalább 4 karakter!';
        }
    } else if (!empty($request['postal_code'])) {

        if (strlen($request['postal_code']) < 4) {
            $error['postal_code'][] = 'Az irányítószám legalább 4 karakter!';
        }
    }


    if ($firstSet) {
        if (empty($request['city'])) {
            $error['city'][] = 'A város nem lehet üres!';
        } else if (strlen($request['city']) < 2) {
            $error['city'][] = 'A város legalább 2 karakter!';
        }
    } else if (!empty($request['city'])) {

        if (strlen($request['city']) < 2) {
            $error['city'][] = 'A város legalább 2 karakter!';
        }
    }


    if ($firstSet) {
        if (empty($request['street'])) {
            $error['street'][] = 'Az utca nem lehet üres!';
        } else if (strlen($request['street']) < 2) {
            $error['street'][] = 'A utca legalább 2 karakter!';
        }
    } else if (!empty($request['street'])) {

        if (strlen($request['street']) < 2) {
            $error['street'][] = 'A utca legalább 2 karakter!';
        }
    }


    if ($firstSet) {
        if (empty($request['house_number'])) {
            $error['house_number'][] = 'A házszám nem lehet üres!';
        }
    }

    return $error;
}




