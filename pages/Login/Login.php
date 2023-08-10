<?php

$m->declareComponents([
    'login'
]);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/twbs/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/code/mobi.css">
    <title>Document</title>
</head>
<body>
    <?php
        $m->loadComponent(['login']);
    ?>
<script src="/code/mobi.js"></script>
<script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>