<?php

# Declara os componentes que serão carregados
$m->declareComponents(['NavBar']);
$m->loadComponent('NavBar');

?>

<section class="d-flex justify-content-center flex-column align-items-center w-100 vh-100 position-fixed">

    <h1 class="text-center">
        <?= $lang->welcome; ?>
    </h1>
    <div>
        <ul class="list-group">
            <li class="list-group-item">An item</li>
            <li class="list-group-item">A second item</li>
            <li class="list-group-item">A third item</li>
            <li class="list-group-item">A fourth item</li>
            <li class="list-group-item">And a fifth one</li>
        </ul>
    </div>

</section>