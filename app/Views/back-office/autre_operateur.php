<?= $this->extend('layout-admin') ?>

<?= $this->section('title') ?>Autres Opérateurs
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Gestion des Autres Opérateurs</h1>
</div>

<!-- Alertes -->
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>
        <?= esc(session()->getFlashdata('error')) ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><i class="bi bi-check-circle-fill me-2"></i>
        <?= esc(session()->getFlashdata('success')) ?>
    </div>
<?php endif; ?>

<!-- Formulaire d'ajout -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <h5 class="card-title text-primary mb-3"><i class="bi bi-plus-circle me-2"></i>Ajouter un préfixe externe</h5>
        <form action="<?= base_url('admin/autres-operateurs/store') ?>" method="post" class="row g-3 align-items-end">
            <?= csrf_field() ?>
            <div class="col-md-3">
                <label class="form-label fw-bold">Préfixe (ex: 032)</label>
                <input type="number" name="prefixe" class="form-control" placeholder="03X" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Nom de l'opérateur</label>
                <input type="text" name="nom_operateur" class="form-control" placeholder="ex: Orange" required>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100 fw-bold">Ajouter</button>
            </div>
        </form>
    </div>
</div>

<!-- Liste des autres opérateurs -->
<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Préfixe</th>
                            <th>Nom Opérateur</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($operateurs)): ?>
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">Aucun opérateur externe configuré.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($operateurs as $op): ?>
                                <tr>
                                    <td class="fw-bold fs-5 text-dark align-middle ps-4">
                                        <?= esc($op['prefixe']) ?>
                                    </td>
                                    <td class="align-middle">
                                        <!-- Code couleur selon l'opérateur (optionnel mais sympa visuellement) -->
                                        <?php
                                        $couleur = 'bg-secondary';
                                        if (strtolower($op['nom_operateur']) == 'orange')
                                            $couleur = 'bg-warning text-dark';
                                        if (strtolower($op['nom_operateur']) == 'airtel')
                                            $couleur = 'bg-danger';
                                        if (strtolower($op['nom_operateur']) == 'telma')
                                            $couleur = 'bg-success';
                                        ?>
                                        <span class="badge <?= $couleur ?> fs-6">
                                            <?= esc($op['nom_operateur']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <form
                                            action="<?= base_url('admin/autres-operateurs/delete/' . $op['id_autre_operateur']) ?>"
                                            method="post">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer le préfixe <?= esc($op['prefixe']) ?> ?')">
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