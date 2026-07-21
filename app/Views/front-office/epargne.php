<?= $this->extend('layout-client') ?>
<?= $this->section('title') ?>Epargne
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Epargne : <?= session()->get('epargne')  ?> % </h1>
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
                <h5 class="card-title text-center mb-4">Epargne</h5>

                <!-- Formulaire -->
                <form action="<?= base_url('client/epargne') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label for="pourcentage" class="form-label fw-bold">Pourcentage de l'éparg</label>
                        <input type="number" class="form-control form-control-lg text-center fs-3" id="pourcentage"
                            name="pourcentage" placeholder="0.00" min="0" step="any" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100 btn-lg mt-2 fw-bold">
                        <i class="bi bi-check2-circle me-1"></i> Valider l'epargne
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>