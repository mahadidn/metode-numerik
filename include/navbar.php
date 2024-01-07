<nav class="navbar navbar-expand-lg bg-dark bg-body-tertiary mb-4" data-bs-theme="dark">
  <div class="container">
    <a class="navbar-brand" href="/">Integrasi Numerik</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <?php
            $title = $_SERVER['REQUEST_URI'];

        ?>
        <li class="nav-item">
        <?php if(strstr(strtolower((string)$title), "romberg")){
            $light = "active";
        }else {$light = "";} ?>
          <a class="nav-link <?= $light ?>" href="../romberg.php">Metode Romberg</a>
        </li>
        <?php if(strstr(strtolower((string)$title), "legendre2titik")){
            $light = "active";
        }else {$light = "";} ?>
        <li class="nav-item">
          <a class="nav-link <?= $light ?>" href="../legendre2titik.php">Metode Gauss Legendre dua titik</a>
        </li>
        <?php if(strstr(strtolower((string)$title), "legendre3titik")){
            $light = "active";
        }else {$light = "";} ?>
        <li class="nav-item">
          <a class="nav-link <?= $light ?>" href="../legendre3titik.php">Metode Gauss Legendre tiga titik </a>
        </li>
      </ul>
    </div>
  </div>
</nav>