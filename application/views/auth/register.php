<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSM POS</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/'); ?>bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">DNA Network Inc.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <!-- <div class="col-sm"> -->
            <!-- One of three columns -->
            <!-- </div> -->

            <div class="col-sm">
                <form action="<?= base_url('auth/register'); ?>" method="post">
                    <div class="card mt-5 ">
                        <div class="card-header">
                            <h4>Form Registrasi</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="uname" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="register" name="register" value="1" hidden>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap">
                                <?= form_error('name', '<small class="text-danger pl-2">*', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="uname" class="form-label">Username / Nickname</label>
                                <input type="text" class="form-control" id="uname" name="uname" placeholder="Username">
                                <?= form_error('uname', '<small class="text-danger pl-2">*', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <?= form_error('password', '<small class="text-danger pl-2">*', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="cpassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
                                <?= form_error('cpassword', '<small class="text-danger pl-2">*', '</small>'); ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="register" class="btn btn-success">Daftar</button>
                            <a class="btn btn-outline-primary" href="<?= base_url('auth'); ?>">Login</a>
                        </div>
                    </div>

                </form>
                <p class="mt-1"><?= $this->session->flashdata('message'); ?></p>
            </div>
            <div class="col-sm">
            </div>
        </div>
    </div>

    </div>

</body>

</html>
<script src="<?= base_url('assets/css/'); ?>bootstrap.min.js"></script>