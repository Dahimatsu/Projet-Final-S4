<?= $this->extend('layout-admin') ?>

<?= $this->section('title') ?>Gestion des Préfixes
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h2 class="mb-4">Gestion des Préfixes</h2>

<form action="/admin/prefixe/store" method="post" class="row g-3 mb-4">
    <?= csrf_field() ?>
    <div class="col-auto">
        <input type="text" name="code" class="form-control" placeholder="ex: 033" required>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </div>
</form>

<!-- Liste -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($prefixes as $prefixe) { ?>
            <tr>
                <td>
                    <?= $prefixe['id'] ?>
                </td>
                <td>
                    <?= $prefixe['code'] ?>
                </td>
                <td>
                <form action="<?= base_url('admin/prefixes/delete/' . $prefixe['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer ?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?= $this->endSection() ?>