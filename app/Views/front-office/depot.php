<?= $this->extend('layout-client') ?>

<?= $this->section('title') ?>Faire un dépôt<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Faire un dépôt</h1>
    <a href="<?= base_url('client/dashboard') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="row justify-content-center mt-4">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="text-success text-center mb-3 fs-1">
                    <i class="bi bi-arrow-down-circle"></i>
                </div>
                <h5 class="card-title text-center mb-4">Alimenter votre compte</h5>

                <!-- Formulaire -->
                <form action="<?= base_url('client/depot') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label for="montant" class="form-label fw-bold">Montant du dépôt (Ar)</label>
                        <input type="number" class="form-control form-control-lg text-center fs-3" id="montant"
                            name="montant" placeholder="0.00" min="100" step="any" required>
                        <div class="form-text text-center mt-2">Le dépôt sur votre propre compte est gratuit.</div>
                    </div>

                    <button type="submit" class="btn btn-success w-100 btn-lg mt-2 fw-bold">
                        <i class="bi bi-check2-circle me-1"></i> Valider le dépôt
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>