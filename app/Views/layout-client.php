<?php
$navlinks = [
    ['url' => '/', 'label' => 'Accueil'],
];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title') ?> · Examen</title>

    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/icons/bootstrap-icons.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>" defer></script>
</head>

<body class="d-flex flex-column">

<header class="fixed-top w-100 px-4 py-3 d-flex align-items-center">
    
    <div class="logo">
        <a href="/" class="text-decoration-none text-reset">
            <strong>Examen</strong>
        </a>
    </div>

    <button class="btn d-lg-none ms-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuOffcanvas">
        <i class="bi bi-list fs-3"></i>
    </button>

    <!-- Offcanvas -->
    <div class="offcanvas-lg offcanvas-end flex-grow-1" tabindex="-1" id="menuOffcanvas">
        
        <div class="offcanvas-header d-lg-none p-4">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#menuOffcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body d-flex flex-column flex-lg-row align-items-lg-center">
            
            <nav class="d-flex flex-column flex-lg-row gap-4 mx-lg-auto">
                <?php foreach ($navlinks as $link) { ?>
                        <?php $activeClass = url_is($link['url']) ? 'active' : ''; ?>
                        <a href="<?= base_url($link['url']) ?>" class="nav-link <?= $activeClass ?>">
                            <?= esc($link['label']) ?>
                        </a>
                    <?php } ?>
                </nav>
    
                <div class="d-flex flex-column flex-lg-row gap-3 align-items-lg-center mt-auto mt-lg-0">
                    <a href="/admin/login" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Backoffice
                    </a>
                </div>
    
            </div>
        </div>
    </header>

    <main class="container flex-grow-1 py-5" style="min-height: 100dvh; margin-top: 40px;">

        <?php if (session()->getFlashdata('error')) { ?>
            <div class="alert alert-danger mt-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i><?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php } ?>

        <?php if (session()->getFlashdata('message')) { ?>
            <div class="alert alert-success mt-4">
                <i class="bi bi-check-circle-fill me-2"></i><?= esc(session()->getFlashdata('message')) ?>
            </div>
        <?php } ?>

        <?= $this->renderSection('content') ?>

    </main>

    <footer class="py-3 mt-4 text-center">
    <small>Examen S4 Design <i class="bi bi-c-circle me-1 ms-1"></i>IT University 2026 | ETU00<strong>4054</strong> - ETU00<strong>4155</strong></small>
    </footer>
</body>

</html>