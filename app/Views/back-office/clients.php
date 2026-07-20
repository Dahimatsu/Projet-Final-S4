<?= $this->extend('layout-admin') ?>

<?= $this->section('title') ?>Gestion des Clients
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3">Liste des clients</h2>
</div>

<table class="table table-hover border">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Nom & Prénom</th>
            <th>Numero Téléphone</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clients as $client): ?>
            <tr>
                <td>
                    <?= esc($client['id_client']) ?>
                </td>
                <td>
                    <?= esc($client['nom']) ?> <?= esc($client['prenom']) ?>
                </td>
                <td>
                    <?= esc($client['numero_telephone']) ?>
                </td>
                <td>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>