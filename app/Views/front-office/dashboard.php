<?= $this->extend('layout-client') ?>

<?= $this->section('title') ?>Tableau de bord<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Section Solde Total -->
<div class="row mt-2 mb-4">
    <div class="col-md-12">
        <div class="card border-0 bg-primary text-white text-center py-4">
            <div class="card-body">
                <h5 class="text-white-50 mb-2">Mon Solde Actuel</h5>
                <h1 class="display-4 fw-bold text-white mb-0">
                    <?= number_format($client['solde'], 2, ',', ' ') ?> Ar
                </h1>
            </div>
        </div>
    </div>
</div>

<!-- Section Actions Rapides -->
<div class="row text-center mb-5">
    <div class="col-md-4 mb-3">
        <a href="<?= base_url('client/depot') ?>" class="btn btn-success btn-lg w-100 py-3 shadow-sm">
            <i class="bi bi-arrow-down-circle d-block fs-2 mb-1"></i> Dépôt
        </a>
    </div>
    <div class="col-md-4 mb-3">
        <a href="<?= base_url('client/retrait') ?>" class="btn btn-warning btn-lg w-100 py-3 text-white shadow-sm">
            <i class="bi bi-arrow-up-circle d-block fs-2 mb-1"></i> Retrait
        </a>
    </div>
    <div class="col-md-4 mb-3">
        <a href="<?= base_url('client/transfert') ?>" class="btn btn-dark btn-lg w-100 py-3 shadow-sm">
            <i class="bi bi-arrow-left-right d-block fs-2 mb-1"></i> Transfert
        </a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center pt-3 pb-2 border-bottom">
        <h5 class="mb-0 fw-bold">Opérations récentes</h5>
        <a href="<?= base_url('client/historique') ?>" class="btn btn-sm btn-outline-primary">Voir tout</a>
    </div>
    <div class="list-group list-group-flush">
        <?php if (empty($dernieres_operations)): ?>
            <div class="text-center text-muted py-5">
                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                Aucune opération récente.
            </div>
        <?php else: ?>
            <?php foreach ($dernieres_operations as $op): ?>
                <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3 fs-3">
                            <?php if ($op['type_operation_id'] == 1): ?>
                                <i class="bi bi-arrow-down-circle-fill text-success"></i>
                            <?php elseif ($op['type_operation_id'] == 2): ?>
                                <i class="bi bi-arrow-up-circle-fill text-warning"></i>
                            <?php else: ?>
                                <i class="bi bi-arrow-left-right text-dark"></i>
                            <?php endif; ?>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">
                                <?= esc($op['type_nom']) ?>
                                <?php if ($op['numero_destinataire']): ?>
                                    <span class="text-muted fw-normal ms-1">vers <?= esc($op['numero_destinataire']) ?></span>
                                <?php endif; ?>
                            </h6>
                            <small class="text-muted">
                                <?= date('d/m/Y à H:i', strtotime($op['date_operation'])) ?>
                            </small>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="fw-bold fs-5 <?= $op['type_operation_id'] == 1 ? 'text-success' : 'text-danger' ?>">
                            <?= $op['type_operation_id'] == 1 ? '+' : '-' ?>         <?= number_format($op['montant'], 2, ',', ' ') ?>
                            Ar
                        </span>
                        <?php if ($op['frais'] > 0): ?>
                            <div class="small text-muted" style="font-size: 0.75rem;">Frais:
                                <?= number_format($op['frais'], 0, ',', ' ') ?> Ar</div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>