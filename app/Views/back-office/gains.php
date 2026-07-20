<?= $this->extend('layout-admin') ?>

<?= $this->section('title') ?>Gestion des Gains<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Récapitulatif des Gains</h1>
</div>

<!-- Carte Total Cumulé -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card bg-primary text-white shadow-sm border-0">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <h5 class="text-white-50 fw-bold mb-2">Total cumulé des gains</h5>
                    <h2 class="mb-0 fw-bold">
                        <?= number_format($totalGains, 2, ',', ' ') ?> Ar
                    </h2>
                </div>
                <i class="bi bi-wallet2 fs-1 text-white-50"></i>
            </div>
        </div>
    </div>
</div>

<!-- Tableau de l'historique -->
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Date & Heure</th>
                    <th>Client (Expéditeur)</th>
                    <th class="text-end">Montant Opération</th>
                    <th class="text-end pe-4">Gain généré</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($gains)): ?>
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Aucun gain enregistré pour le moment.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($gains as $g): ?>
                        <tr>
                            <td class="ps-4 align-middle">
                                <?= date('d/m/Y H:i', strtotime($g['date_operation'])) ?>
                            </td>
                            <td class="align-middle fw-bold">
                                <?= esc($g['client_nom']) ?>         <?= esc($g['client_prenom']) ?>
                            </td>
                            <td class="text-end align-middle">
                                <?= number_format($g['montant'], 2, ',', ' ') ?> Ar
                            </td>
                            <td class="text-end pe-4 fw-bold text-success align-middle">
                                + <?= number_format($g['montant_gain'], 2, ',', ' ') ?> Ar
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Section Pagination -->
    <?php if ($pager): ?>
        <div class="card-footer bg-white d-flex justify-content-center pt-4 pb-2 border-0">
            <?= $pager->links() ?>
        </div>
    <?php endif; ?>
</div>

<!-- Style pour la pagination -->
<style>
    .pagination {
        margin-bottom: 0;
    }

    .pagination li a,
    .pagination li span {
        color: #0d6efd;
        padding: 0.5rem 0.75rem;
        text-decoration: none;
        border: 1px solid #dee2e6;
        margin: 0 2px;
        border-radius: 4px;
    }

    .pagination li.active span {
        background-color: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }
</style>
<?= $this->endSection() ?>