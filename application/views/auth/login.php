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
            /* padding-top: 5%; */
            display: flex;
            background: rgb(255, 233, 156);
            background: linear-gradient(180deg, rgba(255, 233, 156, 1) 35%, rgba(255, 255, 255, 1) 100%);
            /* background-color: rgba(201, 104, 0, 1); */
            height: 100vh;
            width: 100vw;
        }

        .login-form {
            width: 30vw;
            /* background-color: rgba(245, 245, 245, 1); */
            opacity: .8;
            /* border-radius: 2rem; */
            /* padding: 10px 5px 15px 5px; */
        }

        .logo-login {
            height: 15%;
        }

        input[type=password],
        input[type="text"] {
            /* background-color: rgba(64, 56, 47, .6); */
            border: none;
            /* color: beige; */
        }

        input[type=password]:focus,
        input[type="text"]:focus {
            /* background-color: rgba(64, 56, 47, 1); */
            border: none;
            /* color: beige; */
        }

        @media (max-width: 991.98px) {
            .logo-login {
                height: 10%;
            }

            .login-form {
                width: 90vw;
            }


        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center flex-column">
        <!-- <img class="logo-login mb-0" src="<?= base_url('assets/img/'); ?>login-logo.png" alt="login-logo"> -->
        <h1 class="display-1">S N D Y C L L</h1>
        <div class="login-form mt-0">
            <h6 class="text-center">MEMBER LOGIN</h6>
            <form action="<?= base_url('auth'); ?>" method="post" class="mt-2">
                <div class="mb-3">
                    <input type="text" class="form-control" id="uname" name="uname" placeholder="Username">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="mb-3">
                    <div class="d-grid gap-2">
                        <button class="btn btn-dark" type="submit">Login</button>
                    </div>

                </div>
            </form>
            <p class="text-dark">Tidak punya akun? Daftar <a href="<?= base_url('auth/register'); ?>">disini!</a></p>
        </div>
        <br>
        <p class="text-center text-dark">&copy 2022 - 2027 <img src="<?= base_url('assets/img/'); ?>8nite-logo-h-blk.svg" alt="eightnite" class="dev-logo-cpy" height="30rem"> | All rights reserved.</p>
    </div>

</body>

</html>
<script src="<?= base_url('assets/css/'); ?>bootstrap.min.js"></script>