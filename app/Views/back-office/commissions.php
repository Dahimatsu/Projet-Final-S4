<?= $this->extend('layout-admin') ?>

<?= $this->section('title') ?>Configuration Commission
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Configuration de la Commission</h1>
</div>

<!-- Alertes -->
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>
        <?= esc(session()->getFlashdata('error')) ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><i class="bi bi-check-circle-fill me-2"></i>
        <?= esc(session()->getFlashdata('success')) ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="text-primary text-center mb-3 fs-1">
                    <i class="bi bi-percent"></i>
                </div>
                <h5 class="card-title text-center mb-4">Commission vers Autres Opérateurs</h5>
                <p class="text-muted text-center mb-4">
                    Définissez le pourcentage additionnel appliqué lors d'un transfert vers un opérateur externe
                    (Orange, Airtel, etc.).
                </p>

                <!-- On multiplie par 100 pour afficher 10 au lieu de 0.10 -->
                <?php $pourcentageAffichage = $commission['pourcentage'] * 100; ?>

                <form action="<?= base_url('admin/commissions/update') ?>" method="post">
                    <?= csrf_field() ?>
                    <!-- Champ caché pour l'ID -->
                    <input type="hidden" name="id_pourcentage_commission"
                        value="<?= $commission['id_pourcentage_commission'] ?>">

                    <div class="mb-4">
                        <label class="form-label fw-bold">Pourcentage (%)</label>
                        <div class="input-group input-group-lg">
                            <input type="number" name="pourcentage"
                                class="form-control text-center fw-bold text-primary" step="0.1" min="0"
                                value="<?= esc($pourcentageAffichage) ?>" required>
                            <span class="input-group-text bg-light">%</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">
                        <i class="bi bi-save me-2"></i>Enregistrer la modification
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card bg-light border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h6 class="fw-bold"><i class="bi bi-info-circle me-2"></i>Comment ça marche ?</h6>
                <p class="small text-muted mt-3">
                    Si le barème de transfert de base indique des frais de <strong>5 000 Ar</strong>,
                    et que le pourcentage est réglé sur <strong>10%</strong> :
                </p>
                <ul class="small text-muted">
                    <li>Un transfert vers <strong>YAS</strong> coûtera 5 000 Ar de frais.</li>
                    <li>Un transfert vers <strong>Orange/Airtel</strong> coûtera 5 000 Ar + (10% de 5 000 Ar), soit
                        <strong>5 500 Ar</strong>.</li>
                </ul>
                <p class="small text-muted mt-3 mb-0">
                    Cette surtaxe constitue un gain qui ira à YAS pour compenser l'interconnexion réseau.
                </p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>