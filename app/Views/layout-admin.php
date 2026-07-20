<?php
$navlinks = [
    ['url' => '/admin/dashboard', 'label' => 'Dashboard'],
    ['url' => '/admin/prefixes', 'label' => 'Préfixes'],
    ['url' => '/admin/baremes', 'label' => 'Barèmes'],
    ['url' => '/admin/clients', 'label' => 'Clients'],
    ['url' => '/admin/gains', 'label' => 'Gains'],
];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title') ?> · Admin Examen</title>

    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/icons/bootstrap-icons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>" defer></script>
</head>

<body class="d-flex">

    <!-- Sidebar -->
    <nav class="admin-sidebar d-none d-lg-flex flex-column">
        <div class="p-3 text-center border-bottom">
            <strong>Backoffice</strong>
        </div>
        <ul class="nav flex-column mt-3">
            <?php foreach ($navlinks as $link) { ?>
                <?php $activeClass = url_is($link['url']) ? 'active' : ''; ?>
                <li><a href="<?= base_url($link['url']) ?>" class="nav-link <?= $activeClass ?>"><?= esc($link['label']) ?></a></li>
            <?php } ?>
        </ul>
        <div class="mt-auto border-top bg-light bottom">
            <?php if (session()->get('admin_logged_in')) { ?>
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-person-circle fs-5 me-2 text-secondary"></i>
                    <span class="fw-bold text-truncate" title="<?= esc(session()->get('prenom')) ?>">
                        <?= esc(session()->get('prenom')) ?>
                    </span>
                </div>
            <?php } ?>
        
            <a href="/logout" class="nav-link text-danger p-0 d-flex align-items-center">
                <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
            </a>
        </div>
    </nav>

    <div class="flex-grow-1 d-flex flex-column bg-light">
        <header class="px-4 py-3 border-bottom d-flex align-items-center">
            <h5 class="mb-0">Administration</h5>
            <div class="ms-auto d-lg-none">
                <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuOffcanvas"><i
                        class="bi bi-list fs-3"></i></button>
            </div>
        </header>

        <main class="container-fluid p-4 ">
            <?php if (session()->getFlashdata('error')){ ?>
                <div class="alert alert-danger"><i
                        class="bi bi-exclamation-triangle-fill me-2"></i><?= esc(session()->getFlashdata('error')) ?></div>
            <?php } ?>

            <?= $this->renderSection('content') ?>
        </main>

        <footer class="py-3 text-center mt-auto border-top">
            <small>Examen S4 Design <i class="bi bi-c-circle me-1 ms-1"></i>IT University 2026 | ETU00<strong>4054</strong> - ETU00<strong>4155</strong></small>
        </footer>
    </div>

</body>

</html>