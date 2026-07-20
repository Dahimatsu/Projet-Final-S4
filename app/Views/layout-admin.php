<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= $this->renderSection('title') ?> · Admin</title>
    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/icons/bootstrap-icons.min.css') ?>">
    <style>
        .sidebar {
            min-height: 100vh;
            width: 250px;
            background: #343a40;
            color: #fff;
        }

        .sidebar a {
            color: #ccc;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #495057;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar d-flex flex-column flex-shrink-0">
            <a href="/" class="p-3 text-white text-decoration-none"><strong>Admin Mobile Money</strong></a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li><a href="/admin/dashboard" class="nav-link <?= url_is('admin/dashboard') ? 'active' : '' ?>"><i
                            class="bi bi-speedometer2 me-2"></i>Tableau de bord</a></li>
                <li><a href="/admin/prefixe" class="nav-link <?= url_is('admin/prefixe*') ? 'active' : '' ?>"><i
                            class="bi bi-phone me-2"></i>Préfixes</a></li>
                <li><a href="/admin/bareme" class="nav-link <?= url_is('admin/bareme*') ? 'active' : '' ?>"><i
                            class="bi bi-percent me-2"></i>Barèmes frais</a></li>
            </ul>
            <hr>
            <a href="/logout" class="p-3 text-danger"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</a>
        </nav>

        <!-- Contenu -->
        <main class="flex-grow-1 p-4">
            <?php if (session()->getFlashdata('message')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>