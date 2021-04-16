<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSM POS</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/'); ?>bootstrap.min.css">
    <link rel="shortcut icon" href="<?= base_url('assets/img/'); ?>marker.png" type="image/x-icon">
    <link rel="icon" href="<?= base_url('assets/img/'); ?>marker.png" type="image/x-icon">
    <style>
        body {
            padding-top: 5%;
        }

        @media (max-width: 991.98px) {
            .logo-login {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md logo-login">
                <img class="" src="<?= base_url('assets/img/'); ?>login-logo.png" alt="login-logo" width="100%">
            </div>
            <div class="col-md">
                <div class="card mt-5">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-3 mt-3">Account Login</h4>
                        <form action="<?= base_url('auth'); ?>" method="post" class="mt-5">
                            <div class="mb-3">
                                <input type="text" class="form-control me-2" id="uname" name="uname" placeholder="Username">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control me-2" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-dark me-2" type="submit" style="width: 50%;">Login</button>
                            </div>
                        </form>
                        <p>Tidak punya akun? Daftar <a href="<?= base_url('auth/register'); ?>">disini!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<script src="<?= base_url('assets/css/'); ?>bootstrap.min.js"></script>