<?= $this->extend('layout-client') ?>
<?= $this->section('title') ?> Accueil <?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="d-flex flex-column flex-lg-row gap-3 align-items-lg-center mt-auto mt-lg-0">
    <a href="/client/login" class="btn btn-primary">
        <i class="bi bi-box-arrow-in-right me-1"></i>Se Connecter
    </a>
</div>



<?= $this->endSection() ?>