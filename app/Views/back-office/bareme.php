<?= $this->extend('layout-admin') ?>

<?= $this->section('title') ?>Gestion des Barèmes de Frais<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Barèmes de Frais</h1>
</div>

<!-- Alertes -->
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><i
            class="bi bi-exclamation-triangle-fill me-2"></i><?= esc(session()->getFlashdata('error')) ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><i
            class="bi bi-check-circle-fill me-2"></i><?= esc(session()->getFlashdata('success')) ?></div>
<?php endif; ?>

<!-- Formulaire d'ajout -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <h5 class="card-title text-primary mb-3"><i class="bi bi-plus-circle me-2"></i>Ajouter une nouvelle tranche</h5>
        <form action="<?= base_url('admin/baremes/store') ?>" method="post" class="row g-3 align-items-end">
            <?= csrf_field() ?>
            <div class="col-md-3">
                <label class="form-label fw-bold">Type Opération</label>
                <select name="type_operation_id" class="form-select" required>
                    <!-- On ne met pas Dépôt, car il n'y a pas de frais de dépôt -->
                    <?php foreach ($types as $type): ?>
                        <?php if ($type['id'] != 1): // 1 = Dépôt ?>
                            <option value="<?= $type['id'] ?>"><?= esc($type['nom']) ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold">Montant Min</label>
                <input type="number" name="montant_min" class="form-control" placeholder="Ex: 100" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">Montant Max</label>
                <input type="number" name="montant_max" class="form-control" placeholder="Ex: 5000" required>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold">Frais (Ar)</label>
                <input type="number" name="frais" step="any" class="form-control" placeholder="Ex: 150" required>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100 fw-bold">Ajouter</button>
            </div>
        </form>
    </div>
</div>

<!-- Filtre -->
<div class="bg-light p-3 border rounded mb-4 d-flex align-items-end gap-3">
    <form method="get" class="d-flex align-items-end gap-2 w-100">
        <div style="min-width: 250px;">
            <label class="form-label fw-bold text-muted mb-1"><i class="bi bi-funnel me-1"></i>Filtrer par type
                :</label>
            <select name="type_operation_id" class="form-select border-primary" onchange="this.form.submit()">
                <option value="">-- Tous les types --</option>
                <?php foreach ($types as $type): ?>
                    <?php if ($type['id'] != 1): ?>
                        <option value="<?= $type['id'] ?>" <?= service('request')->getGet('type_operation_id') == $type['id'] ? 'selected' : '' ?>>
                            <?= esc($type['nom']) ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <a href="<?= base_url('admin/baremes') ?>" class="btn btn-outline-secondary">Réinitialiser</a>
    </form>
</div>

<!-- Tableau des barèmes -->
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Type Opération</th>
                    <th>Tranche (Min - Max)</th>
                    <th class="text-end">Frais applicables</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($baremes)): ?>
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Aucun barème trouvé.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($baremes as $b): ?>
                        <tr>
                            <td class="align-middle">
                                <span
                                    class="badge <?= $b['type_operation_id'] == 2 ? 'bg-warning text-dark' : 'bg-info text-dark' ?>">
                                    <?= esc($b['type_nom']) ?>
                                </span>
                            </td>
                            <td class="align-middle">
                                <?= number_format($b['montant_min'], 0, ',', ' ') ?> Ar
                                <i class="bi bi-arrow-right mx-2 text-muted"></i>
                                <?= number_format($b['montant_max'], 0, ',', ' ') ?> Ar
                            </td>
                            <td class="text-end align-middle fw-bold text-danger">
                                <?= number_format($b['frais'], 2, ',', ' ') ?> Ar
                            </td>
                            <td class="text-center align-middle">
                                <form action="<?= base_url('admin/baremes/delete/' . $b['id']) ?>" method="post">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Supprimer cette tranche de frais ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>