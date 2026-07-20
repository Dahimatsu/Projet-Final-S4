<?= $this->extend('layout-admin') ?>

<?= $this->section('title') ?>Gestion des Préfixes YAS<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Gestion des Préfixes (YAS)</h1>
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
<form action="<?= base_url('admin/prefixes/store') ?>" method="post" class="row g-3 mb-5 align-items-end">
    <?= csrf_field() ?>
    <div class="col-md-4">
        <label class="form-label fw-bold">Code du préfixe YAS (ex: 034)</label>
        <input type="number" name="code" class="form-control" placeholder="03X" required>
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-plus-circle me-1"></i>Ajouter ce
            préfixe</button>
    </div>
</form>

<!-- Liste des préfixes -->
<div class="row">
    <div class="col-md-7">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Code YAS</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($prefixes)): ?>
                            <tr>
                                <td colspan="2" class="text-center py-4 text-muted">Aucun préfixe YAS configuré.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($prefixes as $p): ?>
                                <tr>
                                    <td class="fw-bold fs-5 text-primary align-middle"><?= esc($p['code']) ?></td>
                                    <td class="text-center align-middle">
                                        <form action="<?= base_url('admin/prefixes/delete/' . $p['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce préfixe ?')">
                                                <i class="bi bi-trash me-1"></i>Supprimer
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
    </div>
</div>
<?= $this->endSection() ?>