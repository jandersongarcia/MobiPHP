<?php

    # Declara os componentes que serão carregados
    $m->declareComponents(['NavBar']);
    $m->loadComponent('NavBar');
    
?>
<section class="d-flex justify-content-center align-items-center w-100 vh-100 position-fixed">
    <div class="container-md bg-light p-2 rounded">
        <h2><i class="bi bi-code-square"></i> <?= $lang->about; ?></h2>
        <div><?= $lang->about_mobi; ?></div>
    </div>
</section>