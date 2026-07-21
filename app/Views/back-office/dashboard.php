<?= $this->extend('layout-admin') ?>

<?= $this->section('title') ?>Tableau de bord<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Tableau de bord Général</h1>
</div>

<!-- Ligne 1 : Les Finances de l'Opérateur -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white shadow-sm h-100 border-0">
            <div class="card-body">
                <h6 class="card-title text-uppercase text-white-50 fw-bold"><i class="bi bi-wallet2 me-2"></i>
                    Gains Total YAS</h6>
                <h3 class="mb-0 fw-bold text-white mt-3"><?= number_format($totalGains, 2, ',', ' ') ?> Ar</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white shadow-sm h-100 border-0">
            <div class="card-body">
                <h6 class="card-title text-uppercase text-white-50 fw-bold"><i
                        class="bi bi-graph-up-arrow me-2"></i>Gains d'aujourd'hui</h6>
                <h3 class="mb-0 fw-bold text-white mt-3">+ <?= number_format($gainsJour, 2, ',', ' ') ?> Ar</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-info text-white shadow-sm h-100 border-0">
            <div class="card-body">
                <h6 class="card-title text-uppercase text-white-50 fw-bold"><i class="bi bi-cash-stack me-2"></i>Argent
                    en circulation</h6>
                <h3 class="mb-0 fw-bold mt-3"><?= number_format($argentCirculation, 2, ',', ' ') ?> Ar</h3>
                <small class="text-white-50">Somme des soldes clients</small>
            </div>
        </div>
    </div>
</div>

<!-- Ligne 2 : Activité de la plateforme -->
<div class="row mb-5">
    <div class="col-md-6">
        <div class="card bg-secondary text-white shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title text-uppercase text-white-50 fw-bold"><i class="bi bi-people me-2"></i>Clients
                        inscrits</h6>
                    <h3 class="mb-0 fw-bold"><?= esc($totalClients) ?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card bg-dark text-white shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title text-uppercase text-white-50 fw-bold"><i
                            class="bi bi-activity me-2"></i>Opérations du jour</h6>
                    <h3 class="mb-0 fw-bold text-white"><?= esc($operationsJour) ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0">
    <div class="card-header bg-white pt-3 pb-2 border-bottom">
        <h5 class="mb-0 fw-bold">Dernières opérations globales</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Date & Heure</th>
                    <th>Client (Expéditeur)</th>
                    <th>Type d'opération</th>
                    <th>Destinataire</th>
                    <th>Montant</th>
                    <th>Frais prélevés</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($dernieresOperations)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Aucune opération enregistrée pour le moment.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($dernieresOperations as $op): ?>
                        <tr>
                            <td><?= date('d/m/Y H:i', strtotime($op['date_operation'])) ?></td>
                            <td class="fw-bold text-primary"><?= esc($op['numero_telephone']) ?></td>
                            <td><span class="badge bg-secondary"><?= esc($op['type_nom']) ?></span></td>
                            <td><?= $op['numero_destinataire'] ? esc($op['numero_destinataire']) : '-' ?></td>
                            <td class="fw-bold text-dark"><?= number_format($op['montant'], 2, ',', ' ') ?> Ar</td>
                            <td class="text-success fw-bold">+ <?= number_format($op['frais'], 2, ',', ' ') ?> Ar</td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>