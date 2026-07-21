<?= $this->extend('layout-admin') ?>

<?= $this->section('title') ?>Gestion des Gains<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Récapitulatif des Gains</h1>
</div>

<!-- Ligne des Totaux (KPIs) -->
<div class="row mb-4">
    <!-- Total Global -->
    <div class="col-md-4 mb-3">
        <div class="card bg-primary text-white shadow-sm border-0 h-100">
            <div class="card-body p-4">
                <h6 class="text-white-50 fw-bold mb-2">Total global généré</h6>
                <h3 class="mb-0 fw-bold text-white"><?= number_format($totalGains, 2, ',', ' ') ?> Ar</h3>
            </div>
        </div>
    </div>
    
    <!-- Part YAS -->
    <div class="col-md-4 mb-3">
        <div class="card bg-success text-white shadow-sm border-0 h-100">
            <div class="card-body p-4">
                <h6 class="text-white-50 fw-bold mb-2">Gains propres à YAS</h6>
                <h3 class="mb-0 fw-bold text-white"><?= number_format($totalGainsYas, 2, ',', ' ') ?> Ar</h3>
            </div>
        </div>
    </div>

    <!-- Part Autres Opérateurs -->
    <div class="col-md-4 mb-3">
        <div class="card bg-warning text-dark shadow-sm border-0 h-100">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-2 opacity-75">Gains des autres opérateurs</h6>
                <h3 class="mb-0 fw-bold"><?= number_format($totalGainsAutres, 2, ',', ' ') ?> Ar</h3>
            </div>
        </div>
    </div>
</div>

<!-- Tableau de l'historique -->
<div class="card border-0">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Date & Heure</th>
                    <th>Client</th>
                    <th>Numéro</th>
                    <th>Bénéficiaire du gain</th>
                    <th class="text-end">Montant Opération</th>
                    <th class="text-end pe-4">Gain généré</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($gains)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Aucun gain enregistré pour le moment.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($gains as $g): ?>
                        <?php 
                            $isYas = true;
                            if ($g['type_operation_id'] == 3 && !empty($g['numero_destinataire'])) {
                                $prefixeDest = substr($g['numero_destinataire'], 0, 3);
                                if (!in_array($prefixeDest, $prefixesYas)) {
                                    $isYas = false;
                                }
                            }
                        ?>
                        <tr>
                            <td class="ps-4 align-middle">
                                <?= date('d/m/Y H:i', strtotime($g['date_operation'])) ?>
                            </td>
                            <td class="align-middle fw-bold">
                                <?= esc($g['client_nom']) ?> <?= esc($g['client_prenom']) ?>
                            </td>
                            <td class="align-middle fw-bold">
                                <?= esc($g['client_numero']) ?>
                            </td>
                            <td class="align-middle">
                                <?php if ($isYas): ?>
                                    <span class="badge bg-success">YAS</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Autre Opérateur</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end align-middle">
                                <?= number_format($g['montant'], 2, ',', ' ') ?> Ar
                            </td>
                            <td class="text-end pe-4 fw-bold <?= $isYas ? 'text-success' : 'text-warning' ?> align-middle">
                                + <?= number_format($g['frais'], 2, ',', ' ') ?> Ar
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <?php if ($pager): ?>
        <div class="card-footer bg-white d-flex justify-content-center pt-4 pb-2 border-0">
            <?= $pager->links() ?>
        </div>
    <?php endif; ?>
</div>

<style>
    .pagination { margin-bottom: 2; }
    .pagination li a, .pagination li span {
        color: #0d6efd; padding: 0.5rem 0.75rem; text-decoration: none;
        border: 1px solid #dee2e6; margin: 0 2px; border-radius: 4px;
    }
    .pagination li.active span {
        background-color: #0d6efd; color: white; border-color: #0d6efd;
    }
</style>
<?= $this->endSection() ?>