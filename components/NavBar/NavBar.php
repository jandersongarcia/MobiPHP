<nav class="navbar navbar-expand-lg navbar-light bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="./">Mobi<strong>PHP</strong></a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <i class="bi bi-three-dots-vertical"></i>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="./docs"><?= $lang->documentation; ?></a>
        </li>

        <!-- Dropdown de seleção de idioma -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false"><i class="bi bi-translate"></i> <?= $lang->language; ?></a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
            
            <li><a class="dropdown-item" href="#" onclick="language('en')"><?= $lang->english; ?></a></li>
            <li><a class="dropdown-item" href="#" onclick="language('esp')"><?= $lang->spanish; ?></a></li>
            <li><a class="dropdown-item" href="#" onclick="language('pt-br')"><?= $lang->portuguese; ?></a></li>
            <!-- Adicione mais idiomas conforme necessário -->
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://github.com/jandersongarcia/MobiPHP" target="_blank">
            <i class="bi bi-github"></i> Git</a>
        </li>
      </ul>
    </div>
  </div>
</nav>