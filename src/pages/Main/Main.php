<?php

    # Declara os componentes que serão carregados
    $m->declareComponents(['NavBar']);
    $m->loadComponent('NavBar');
    
?>

<section class="d-flex justify-content-center align-items-center w-100 vh-100 position-fixed">

        <h1 class="text-center"><?= $lang->welcome; ?><br>😁</h1>

</section>