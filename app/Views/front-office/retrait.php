<?= $this->extend('layout-client') ?>

<?= $this->section('title') ?>Faire un retrait<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Faire un retrait</h1>
    <a href="<?= base_url('client/dashboard') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="row justify-content-center mt-4">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="text-warning text-center mb-3 fs-1">
                    <i class="bi bi-arrow-up-circle"></i>
                </div>
                <h5 class="card-title text-center mb-4">Retirer de l'argent</h5>
                
                <!-- Formulaire -->
                <form action="<?= base_url('client/retrait') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label for="montant" class="form-label fw-bold">Montant à retirer (Ar)</label>
                        <input type="number" class="form-control form-control-lg text-center fs-3" id="montant"
                            name="montant" placeholder="0.00" min="100" step="any" required>
                        <div class="form-text text-center mt-2 text-warning">
                            <i class="bi bi-info-circle me-1"></i>Des frais de retrait seront appliqués et déduits de
                            votre solde selon le barème en vigueur.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 btn-lg mt-2 text-white fw-bold">
                        <i class="bi bi-cash-stack me-1"></i> Confirmer le retrait
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>