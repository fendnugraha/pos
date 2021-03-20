<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSM POS</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/'); ?>bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <!-- One of three columns -->
                </div>
                <div class="col-sm">
                    <!-- One of three columns -->
                </div>
                <div class="col-sm">
                    <form action="<?= base_url('auth'); ?>" method="post">
                        <div class="card mt-5 ">
                            <div class="card-header">
                                <h4>LOGIN PAGE</h4>
                            </div>
                            <div class="card-body">
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
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                                <a href="http://">Register</a>
                            </div>
                        </div>

                    </form>
                    <p><?= $this->session->flashdata('message'); ?></p>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
<script src="<?= base_url('assets/css/'); ?>bootstrap.min.js"></script>