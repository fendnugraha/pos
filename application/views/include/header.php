<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSM POS</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/'); ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/'); ?>all.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/'); ?>fontawesome.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/'); ?>datatables.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/'); ?>dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/'); ?>jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/'); ?>mycss.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('home'); ?>"><?= $setting['namakonter']; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url('home'); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('transact'); ?>">Transaction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('home/report'); ?>">Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('home/setting'); ?>">Setting</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">Logout</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown link
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> -->
                </ul>
                <span class="navbar-text">
                    User currently logged in is <strong><?= ucwords($user['name']); ?></strong></span>
            </div>
        </div>
    </nav>