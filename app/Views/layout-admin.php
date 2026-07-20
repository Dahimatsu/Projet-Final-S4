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

    <style>
        /* Sidebar styles harmonisés avec ton style.css */
        
    </style>
</head>

<body class="d-flex">

    <!-- Sidebar -->
    <nav class="admin-sidebar d-none d-lg-flex flex-column">
        <div class="p-3 text-center border-bottom">
            <strong>Backoffice</strong>
        </div>
        <ul class="nav flex-column mt-3">
            <li><a href="/admin/dashboard" class="nav-link <?= url_is('admin/dashboard') ? 'active' : '' ?>"><i
                        class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
            <li><a href="/admin/prefixe" class="nav-link <?= url_is('admin/prefixe*') ? 'active' : '' ?>"><i
                        class="bi bi-phone me-2"></i>Préfixes</a></li>
            <li><a href="/admin/bareme" class="nav-link <?= url_is('admin/bareme*') ? 'active' : '' ?>"><i
                        class="bi bi-percent me-2"></i>Barèmes</a></li>
        </ul>
        <div class="mt-auto p-3 border-top">
            <a href="/logout" class="nav-link text-danger"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</a>
        </div>
    </nav>

    <!-- Contenu Principal -->
    <div class="flex-grow-1 d-flex flex-column">
        <header class="px-4 py-3 border-bottom d-flex align-items-center">
            <h5 class="mb-0">Administration</h5>
            <div class="ms-auto d-lg-none">
                <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuOffcanvas"><i
                        class="bi bi-list fs-3"></i></button>
            </div>
        </header>

        <main class="container-fluid p-4">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><i
                        class="bi bi-exclamation-triangle-fill me-2"></i><?= esc(session()->getFlashdata('error')) ?></div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </main>

        <footer class="py-3 text-center mt-auto border-top">
            <small>Examen S4 Design <i class="bi bi-c-circle me-1 ms-1"></i>IT University 2026</small>
        </footer>
    </div>

</body>

</html>