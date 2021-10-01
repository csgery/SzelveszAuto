<?php
session_start();
require_once 'private/lib/config.php';



?>


<!doctype html>
<html lang="hu">
<head>
    <title>Szélvész Autókereskedés</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="icon" type="image/png" href="public/img/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/append.css">

</head>
<body class="d-flex flex-column min-vh-100">

<?php @include_once 'private/components/header.php'; ?>



<?php @require_once 'private/components/nav.php'; ?>


<main class="container">

    <?php @require_once 'private/lib/router.php'; ?>


</main>

<footer class="mt-auto">

    <?php include_once 'private/components/footer.php'; ?>

</footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


</body>
</html>