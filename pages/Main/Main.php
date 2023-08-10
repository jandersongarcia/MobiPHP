<?php

$m->declareComponents([
    'nav-left',
    'nav-right',
    'settings-menu',
    'thinking',
    'left-colum',
    'post-container',
    'right-colum'
]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/code/mobi.css">
    <title>OnlyTeachers</title>
</head>

<body>
    <obfuscate>
        <nav>
            <?= $m->loadComponent(['nav-left', 'nav-right', 'settings-menu']) ?>
        </nav>

        <section>
            <div id="generalContainer" class="container">

                <?php
                # Coluna esquerda
                $m->loadComponent('left-colum');

                # Conteudo central
                echo '<div id="mainContainer">';

                # Carrega componentes da div
                $m->loadComponent([
                    'thinking',
                    'post-container'
                ]);

                # fecha div mainContainer
                echo '</div>';

                # Coluna da direita
                $m->loadComponent('right-colum');

                ?>
            </div>
        </section>

        <script src="/code/mobi.js"></script>
    </obfuscate>
</body>

</html>