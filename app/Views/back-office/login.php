<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion Admin · Examen</title>

    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/icons/bootstrap-icons.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h4 class="text-center mb-4">Login Backoffice</h4>

                        <?php if (session()->getFlashdata('error')){ ?>
                            <div class="alert alert-danger mb-3">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php } ?>

                        <form action="<?= base_url('admin/login/authenticate') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="admin@example.com"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Mot de passe</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Se connecter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>