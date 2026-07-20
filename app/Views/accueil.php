<?= $this->extend('layout-client') ?>
<?= $this->section('title') ?> Accueil <?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="text-center py-5">
    <h1>Bienvenue sur Operateur</h1>
    <p class="lead">Gérez vos opérations bancaires en toute simplicité.</p>

    <div class="d-flex justify-content-center gap-3 mt-4">
        <?php if (!session()->get('client_logged_in')): ?>
            <a href="/client/login" class="btn btn-primary btn-lg">
                <i class="bi bi-box-arrow-in-right me-1"></i> Se Connecter
            </a>
        <?php endif; ?>

        <a href="/admin/login" class="btn btn-secondary btn-lg">
            <i class="bi bi-shield-lock me-1"></i> Accès Backoffice
        </a>
    </div>
</div>



<?= $this->endSection() ?>