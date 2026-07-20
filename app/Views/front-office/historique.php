<?= $this->extend('layout-client') ?>
<?= $this->section('title') ?>Mon Historique
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Historique des opérations</h1>
    <a href="<?= base_url('client/dashboard') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Destinataire</th>
                    <th>Montant</th>
                    <th>Frais payés</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($operations)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Aucune opération trouvée.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($operations as $op): ?>
                        <tr>
                            <td>
                                <?= esc($op['date_operation']) ?>
                            </td>
                            <td><span class="badge bg-secondary">
                                    <?= esc($op['type_nom']) ?>
                                </span></td>
                            <td>
                                <?= $op['numero_destinataire'] ? esc($op['numero_destinataire']) : '-' ?>
                            </td>
                            <td class="fw-bold <?= $op['type_operation_id'] == 1 ? 'text-success' : 'text-danger' ?>">
                                <?= $op['type_operation_id'] == 1 ? '+' : '-' ?>
                                <?= number_format($op['montant'], 2, ',', ' ') ?> Ar
                            </td>
                            <td class="text-muted">
                                <?= number_format($op['frais'], 2, ',', ' ') ?> Ar
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>