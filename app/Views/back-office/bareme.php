<?= $this->extend('layout-admin') ?>

<?= $this->section('title') ?>Gestion des Barèmes
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h2 class="mb-4">Barèmes de frais</h2>

<!-- Formulaire d'ajout -->
<form action="/admin/baremes/store" method="post" class="row g-3 mb-4 align-items-end">
    <?= csrf_field() ?>
    <div class="col-md-3">
        <label>Type Opération</label>
        <select name="type_operation_id" class="form-select" required>
            <!-- À remplir avec tes types d'opérations (Dépôt=1, Retrait=2, etc.) -->
            <option value="1">Dépôt</option>
            <option value="2">Retrait</option>
            <option value="3">Transfert</option>
        </select>
    </div>
    <div class="col-md-2">
        <label>Min</label>
        <input type="number" name="montant_min" class="form-control" required>
    </div>
    <div class="col-md-2">
        <label>Max</label>
        <input type="number" name="montant_max" class="form-control" required>
    </div>
    <div class="col-md-2">
        <label>Frais</label>
        <input type="number" name="frais" step="0.01" class="form-control" required>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">Ajouter</button>
    </div>
</form>

<!-- Formulaire de filtrage -->
<form method="get" class="row g-3 mb-4 bg-light p-3 border rounded align-items-end">
    <div class="col-md-4">
        <label>Filtrer par type :</label>
        <select name="type_operation_id" class="form-select" onchange="this.form.submit()">
            <option value="">Tous les types</option>
            <?php foreach ($types as $type): ?>
                <option value="<?= $type['id'] ?>" <?= service('request')->getGet('type_operation_id') == $type['id'] ? 'selected' : '' ?>>
                    <?= $type['nom'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-2">
        <a href="/admin/baremes" class="btn btn-secondary">Réinitialiser</a>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Opération</th>
            <th>Tranche (Min - Max)</th>
            <th>Frais</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($baremes as $b): ?>
            <tr>
                <td>
                    <?= $b['type_nom'] ?>
                </td>
                <td>
                    <?= $b['montant_min'] ?> -
                    <?= $b['montant_max'] ?>
                </td>
                <td>
                    <?= $b['frais'] ?> Ar
                </td>
                <td>
                    <form action="<?= base_url('admin/baremes/delete/' . $b['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>