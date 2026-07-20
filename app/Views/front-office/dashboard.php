<?= $this->extend('layout-client') ?>

<?= $this->section('title') ?>Tableau de bord<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tableau de bord</h1>
    <span class="text-muted">Bienvenue, <strong><?= session()->get('prenom') ?? 'Client' ?></strong></span>
</div>

<<<<<<< HEAD
=======
<!-- Ligne du Solde -->
>>>>>>> f5b9bc32f762f9cb1569a376fcc23b2f8105261e
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card bg-primary text-white shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0">Solde actuel</h5>
<<<<<<< HEAD
                    <p class="card-text fs-2 fw-bold mb-0">150 000 Ar</p>
=======
                    <p class="card-text fs-2 fw-bold mb-0">
                        <!-- Remplacez par votre variable de solde ex: <?= $solde ?? '0.00' ?> Ar -->
                        150 000 Ar
                    </p>
>>>>>>> f5b9bc32f762f9cb1569a376fcc23b2f8105261e
                </div>
                <div>
                    <a href="<?= base_url('client/solde') ?>" class="btn btn-light btn-sm">
                        <i class="bi bi-eye"></i> Voir les détails
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<<<<<<< HEAD
<div class="row g-3">
=======
<!-- Grille des actions rapides -->
<div class="row g-3">
    <!-- Dépôt -->
>>>>>>> f5b9bc32f762f9cb1569a376fcc23b2f8105261e
    <div class="col-md-3">
        <div class="card shadow-sm h-100 text-center border-0">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <div class="text-success mb-2 fs-1"><i class="bi bi-arrow-down-circle"></i></div>
                    <h5 class="card-title">Faire un dépôt</h5>
                    <p class="card-text text-muted small">Alimentez votre compte instantanément.</p>
                </div>
                <a href="<?= base_url('client/depot') ?>" class="btn btn-outline-success w-100 mt-3">Déposer</a>
            </div>
        </div>
    </div>

<<<<<<< HEAD
=======
    <!-- Retrait -->
>>>>>>> f5b9bc32f762f9cb1569a376fcc23b2f8105261e
    <div class="col-md-3">
        <div class="card shadow-sm h-100 text-center border-0">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <div class="text-warning mb-2 fs-1"><i class="bi bi-arrow-up-circle"></i></div>
                    <h5 class="card-title">Faire un retrait</h5>
                    <p class="card-text text-muted small">Retirez de l'argent automatiquement.</p>
                </div>
                <a href="<?= base_url('client/retrait') ?>" class="btn btn-outline-warning w-100 mt-3">Retirer</a>
            </div>
        </div>
    </div>

<<<<<<< HEAD
=======
    <!-- Transfert -->
>>>>>>> f5b9bc32f762f9cb1569a376fcc23b2f8105261e
    <div class="col-md-3">
        <div class="card shadow-sm h-100 text-center border-0">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <div class="text-primary mb-2 fs-1"><i class="bi bi-arrow-left-right"></i></div>
                    <h5 class="card-title">Faire un transfert</h5>
                    <p class="card-text text-muted small">Envoyez des fonds vers un autre compte.</p>
                </div>
                <a href="<?= base_url('client/transfert') ?>" class="btn btn-outline-primary w-100 mt-3">Transférer</a>
            </div>
        </div>
    </div>

<<<<<<< HEAD
=======
    <!-- Historiques -->
>>>>>>> f5b9bc32f762f9cb1569a376fcc23b2f8105261e
    <div class="col-md-3">
        <div class="card shadow-sm h-100 text-center border-0">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <div class="text-secondary mb-2 fs-1"><i class="bi bi-clock-history"></i></div>
                    <h5 class="card-title">Historiques</h5>
                    <p class="card-text text-muted small">Consultez toutes vos opérations passées.</p>
                </div>
                <a href="<?= base_url('client/historiques') ?>" class="btn btn-outline-secondary w-100 mt-3">Voir l'historique</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>