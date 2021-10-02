<?php
$PAGE = $_GET['p'] ?? 'home';

if(file_exists("private/pages/$PAGE.php")){
    require_once  "private/pages/$PAGE.php";
}

else{

    require_once 'private/pages/errors/404.php';
}
