<?= $this->extend('layout-client') ?>

<?= $this->section('title') ?>Faire un transfert<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Faire un transfert</h1>
    <a href="<?= base_url('client/dashboard') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="row justify-content-center mb-5">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="text-primary text-center mb-3 fs-1"><i class="bi bi-arrow-left-right"></i></div>
                <h5 class="card-title text-center mb-4">Envoyer des fonds</h5>

                <form action="<?= base_url('client/transfert') ?>" method="post" id="form-transfert">
                    <?= csrf_field() ?>

                    <label class="form-label">Numéro(s) du destinataire</label>
                    <div id="destinataires-container">
                        <!-- Première Ligne Destinataire -->
                        <div class="input-group mb-2 destinataire-row">
                            <select class="form-select prefixe-select" name="prefixe[]" style="max-width: 120px;"
                                required>
                                <optgroup label="YAS">
                                    <option value="034">034</option>
                                    <option value="038">038</option>
                                </optgroup>
                                <optgroup label="Autres" class="autres-group">
                                    <option value="032">032</option>
                                    <option value="033">033</option>
                                    <option value="037">037</option>
                                </optgroup>
                            </select>
                            <input type="text" class="form-control" name="suffixe[]" placeholder="Ex: 1234567"
                                maxlength="7" required>
                            <button type="button" class="btn btn-outline-danger btn-remove d-none"><i
                                    class="bi bi-x-lg"></i></button>
                        </div>
                    </div>

                    <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="btn-add-dest">
                        <i class="bi bi-plus-lg"></i> Ajouter un autre numéro
                    </button>

                    <div class="mb-3">
                        <label for="montant" class="form-label">Montant Total à transférer (Ar)</label>
                        <input type="number" class="form-control form-control-lg" id="montant" name="montant"
                            placeholder="Ex: 10000" min="100" step="any" required>
                        <div class="form-text footnote" id="montant-help">S'il y a plusieurs numéros, le montant sera divisé à
                            parts égales.</div>
                    </div>

                    <!-- Option Frais -->
                    <div class="form-check mb-4 bg-light p-3 border rounded">
                        <input class="form-check-input ms-1" type="checkbox" id="inclure_frais"
                            name="inclure_frais_retrait" value="1">
                        <label class="form-check-label ms-2 fw-bold" for="inclure_frais">
                            Inclure les frais de retrait
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-lg mt-2">Envoyer le transfert</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('destinataires-container');
        const btnAdd = document.getElementById('btn-add-dest');

        // Fonction pour gérer les règles métier
        function updateRules() {
            const rows = document.querySelectorAll('.destinataire-row');
            const isMultiple = rows.length > 1;

            // Afficher/Cacher le bouton supprimer
            rows.forEach((row, index) => {
                const btnRemove = row.querySelector('.btn-remove');
                if (isMultiple) btnRemove.classList.remove('d-none');
                else btnRemove.classList.add('d-none');
            });

            // Désactiver les opérateurs "Autres" si envoi multiple
            document.querySelectorAll('.autres-group option').forEach(opt => {
                opt.disabled = isMultiple;
                // Si on passe en multiple et qu'un "Autre" était sélectionné, on force le 034
                if (isMultiple && opt.selected) {
                    opt.parentElement.parentElement.value = "034";
                }
            });
        }

        // Ajouter une ligne
        btnAdd.addEventListener('click', function () {
            const firstRow = container.querySelector('.destinataire-row');
            const newRow = firstRow.cloneNode(true);
            newRow.querySelector('input[type="text"]').value = ''; // vider le champ
            container.appendChild(newRow);
            updateRules();
        });

        // Supprimer une ligne
        container.addEventListener('click', function (e) {
            if (e.target.closest('.btn-remove')) {
                const row = e.target.closest('.destinataire-row');
                row.remove();
                updateRules();
            }
        });
    });
</script>
<?= $this->endSection() ?>