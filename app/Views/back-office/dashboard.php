<?= $this->extend('layout-admin') ?>

<?= $this->section('title') ?>Tableau de bord<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tableau de bord</h1>
</div>

<div class="row">
    <!-- Total Clients -->
    <div class="col-md-4">
        <div class="card bg-primary text-white mb-3">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-people me-2"></i>Clients inscrits</h5>
                <p class="card-text fs-2 fw-bold"><?= esc($totalClients) ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white mb-3">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-journal-text me-2"></i>Opérations du jour</h5>
                <p class="card-text fs-2 fw-bold"><?= esc($operationsJour) ?></p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>