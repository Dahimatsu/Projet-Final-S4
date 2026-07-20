<?= $this->extend('layout-client') ?>

<?= $this->section('title') ?>Faire un retrait<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Faire un retrait</h1>
    <a href="<?= base_url('client/dashboard') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="text-warning text-center mb-3 fs-1"><i class="bi bi-arrow-up-circle"></i></div>
                <h5 class="card-title text-center mb-4">Retirer de l'argent</h5>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('client/retrait') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="montant" class="form-label">Montant du retrait (Ar)</label>
                        <input type="number" class="form-control form-control-lg" id="montant" name="montant" placeholder="Ex: 20000" min="100" step="any" required>
                        <div class="form-text">Des frais de retrait seront appliqués selon le barème en vigueur.</div>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 btn-lg mt-3 text-white">Valider le retrait</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>