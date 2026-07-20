<?php
$navlinks = [
    ['url' => '/client/dashboard', 'label' => 'Dashboard', 'icon' => 'bi-speedometer2'],
    ['url' => '/client/solde', 'label' => 'Solde', 'icon' => 'bi-wallet2'],
    ['url' => '/client/depot', 'label' => 'Dépôt', 'icon' => 'bi-arrow-down-circle'],
    ['url' => '/client/retrait', 'label' => 'Retrait', 'icon' => 'bi-arrow-up-circle'],
    ['url' => '/client/transfert', 'label' => 'Transfert', 'icon' => 'bi-arrow-left-right'],
    ['url' => '/client/historiques', 'label' => 'Historiques', 'icon' => 'bi-clock-history'],
];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title') ?> · Client</title>

    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/icons/bootstrap-icons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>" defer></script>
</head>

<body class="d-flex">

    <!-- Sidebar -->
    <nav class="admin-sidebar d-none d-lg-flex flex-column">

        <div class="p-3 text-center border-bottom">
            <strong>Espace Client</strong>
        </div>

        <ul class="nav flex-column mt-3">
            <?php foreach ($navlinks as $link): ?>
                <?php $active = url_is(trim($link['url'], '/')) ? 'active' : ''; ?>

                <li>
                    <a href="<?= base_url($link['url']) ?>" class="nav-link <?= $active ?>">
                        <i class="bi <?= $link['icon'] ?> me-2"></i>
                        <?= esc($link['label']) ?>
                    </a>
                </li>

            <?php endforeach; ?>
        </ul>

        <div class="mt-auto border-top bg-light p-3">

            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-person-circle fs-4 me-2 text-secondary"></i>

                <div>
                    <div class="fw-bold">
                        <?= esc(session()->get('prenom')) ?>
                    </div>

                    <small class="text-muted">
                        <?= esc(session()->get('numero_telephone')) ?>
                    </small>
                </div>
            </div>

            <a href="<?= base_url('client/logout') ?>"
                class="nav-link text-danger p-0 d-flex align-items-center">

                <i class="bi bi-box-arrow-right me-2"></i>
                Déconnexion

            </a>

        </div>

    </nav>

    <!-- Contenu -->
    <div class="flex-grow-1 d-flex flex-column bg-light">

        <header class="px-4 py-3 border-bottom d-flex align-items-center">

            <h5 class="mb-0">
                Espace Client
            </h5>

        </header>

        <main class="container-fluid p-4">

            <?php if (session()->getFlashdata('error')): ?>

                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>

            <?php endif; ?>

            <?php if (session()->getFlashdata('message')): ?>

                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?= esc(session()->getFlashdata('message')) ?>
                </div>

            <?php endif; ?>

            <?= $this->renderSection('content') ?>

        </main>

        <footer class="py-3 text-center border-top mt-auto">
            <small>
                Examen S4 Design
                <i class="bi bi-c-circle mx-1"></i>
                IT University 2026 |
                ETU004054 - ETU004155
            </small>
        </footer>

    </div>

</body>

</html>