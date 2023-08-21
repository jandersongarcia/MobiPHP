<?php

    # Declara os componentes que serão carregados
    $m->declareComponents(['NavBar']);
    $m->loadComponent('NavBar');
    
?>
<div id="notFound" class="d-flex justify-content-center align-items-center flex-column w-100 vh-100 position-fixed">
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="mr-3 pr-3 align-top border-right inline-block align-content-center">404</h1>
        <h2 class="font-weight-normal lead ms-3" id="desc">
            <?= $lang->page_not_found; ?>
        </h2>
    </div>
    <div>
        <a href="./"><?= $lang->back_to_home; ?></a>
    </div>
</div>