<?= $this->extend('layout-admin') ?>

<?= $this->section('title') ?>Tableau de bord
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tableau de bord</h1>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card text-white mb-3">
            <div class="card-body">
                <h5 class="card-title">Clients inscrits</h5>
                <p class="card-text fs-3">--</p> 
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Opérations du jour</h5>
                <p class="card-text fs-3">--</p>
            </div>
        </div>
    </div>
</div>

<p>Bienvenue sur votre espace de gestion,
    
</p>
<?= $this->endSection() ?>