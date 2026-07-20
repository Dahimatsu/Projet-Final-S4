<?= $this->extend('layout-client') ?>

<?= $this->section('title') ?>Connexion client<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
	<div class="col-lg-6 col-xl-5">
		<div class="card shadow-sm border-0">
			<div class="card-body p-4 p-md-5">
				<h1 class="h3 mb-4">Connexion client</h1>

				<?php if (session()->getFlashdata('notExist')) : ?>
					<div class="alert alert-warning">
						<?= esc(session()->getFlashdata('notExist')) ?>
					</div>
				<?php endif; ?>

				<form action="<?= base_url('client/login/authenticate') ?>" method="post" class="vstack gap-3">
					<?= csrf_field() ?>

					<div>
						<label for="prefixe" class="form-label">Préfixe</label>
						<select name="prefixe" id="prefixe" class="form-select" required>
							<option value="" selected disabled>Choisir un préfixe</option>
							<?php foreach ($data as $prefix) : ?>
								<option value="<?= esc($prefix['code']) ?>"><?= esc($prefix['code']) ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div>
						<label for="suffixe" class="form-label">Numéro</label>
						<input type="text" name="suffixe" id="suffixe" class="form-control" placeholder="Ex: 123456789" required>
					</div>

					<button type="submit" class="btn btn-primary w-100">Se connecter</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>