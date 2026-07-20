<?= $this->extend('layout-client') ?>

<?= $this->section('title') ?>Faire un transfert<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Faire un transfert</h1>
    <a href="<?= base_url('client/dashboard') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="text-primary text-center mb-3 fs-1"><i class="bi bi-arrow-left-right"></i></div>
                <h5 class="card-title text-center mb-4">Envoyer des fonds</h5>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('client/transfert') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <!-- Gestion du numéro avec Préfixe / Suffixe -->
                    <div class="mb-3">
                        <label class="form-label">Numéro du destinataire</label>
                        <div class="input-group">
                            <select class="form-select" name="prefixe" style="max-width: 110px;" required>
                                <option value="032">032</option>
                                <option value="033">033</option>
                                <option value="034">034</option>
                                <option value="038">038</option>
                            </select>
                            <input type="text" class="form-control" name="suffixe" placeholder="Ex: 1234567" maxlength="7" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="montant" class="form-label">Montant à transférer (Ar)</label>
                        <input type="number" class="form-control form-control-lg" id="montant" name="montant" placeholder="Ex: 10000" min="100" step="any" required>
                        <div class="form-text">Des frais de transfert s'ajouteront au montant prélevé.</div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-lg mt-3">Envoyer le transfert</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>