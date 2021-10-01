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

        if (strlen($request['password']) > 8) {
            $error['password'][] = 'A jelszó legalább 8 karakter!';
        } else if ($request['password'] !== $request['password_confirmation']) {
            $error['password_confirmation'][] = 'A jelszó és a megerősítése nem egyezik!';
        }
    }


    return $error;
}





