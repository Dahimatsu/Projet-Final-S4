<?= $this->extend('layout-admin') ?>

<?= $this->section('title') ?>Gestion des Clients<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Liste des clients</h1>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Nom & Prénom</th>
                    <th>Numéro de Téléphone</th>
                    <th class="text-end pe-4">Solde Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($clients)): ?>
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Aucun client inscrit pour le moment.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td class="ps-4 text-muted align-middle">
                                #<?= esc($client['id_client']) ?>
                            </td>
                            <td class="fw-bold align-middle">
                                <?= esc($client['nom']) ?>         <?= esc($client['prenom']) ?>
                            </td>
                            <td class="align-middle">
                                <span class="badge bg-primary fs-6">
                                    <?= esc($client['numero_telephone']) ?>
                                </span>
                            </td>
                            <td class="text-end pe-4 align-middle fw-bold text-success">
                                <?= number_format($client['solde'], 2, ',', ' ') ?> Ar
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
    .pagination {
        margin-bottom: 3;
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