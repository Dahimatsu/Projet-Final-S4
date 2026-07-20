<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion Client · Examen</title>

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
                        <h4 class="text-center mb-4">Se connecter</h4>

                        <?php if (session()->getFlashdata('notExist')){ ?>
                            <div class="alert alert-primary mb-3">
                                <?= session()->getFlashdata('notExist') ?>
                            </div>
                            <form action="<?= base_url('client/login/firstAuthenticate') ?>" method="post">
                                <?= csrf_field() ?>

                                <div class="mb-3">
                                    <label class="form-label">Nom</label>
                                    <input type="text" name="nom" class="form-control" placeholder="RAKOTO"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Prénom</label>
                                    <input type="text" name="prenom" class="form-control" placeholder="Jean Martin"
                                        required>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> Se connecter
                                </button>
                            </form>
                        <?php } else { ?>
                            <form action="<?= base_url('client/login/authenticate') ?>" method="post">
                                <?= csrf_field() ?>

                                <div class="mb-3">
                                    <label class="form-label d-block">Numéro de téléphone</label>
                                    
                                    <div class="row g-2">

                                        <div class="col-4">
                                            <select name="prefixe" class="form-select">
                                                <?php for($i=0; $i<count($data); $i++) { ?>
                                                    <option value="<?= $data[$i]['code'] ?>"><?= $data[$i]['code'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-8">
                                            <input type="text" name="suffixe" class="form-control" placeholder="xx xxx xx" required>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> Se connecter
                                </button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>