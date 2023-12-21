<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS - <?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/jquery-ui.css" />
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/dataTables.bootstrap5.min.css" />
    <!-- <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/dataTables.jqueryui.min.css" /> -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/fontawesome.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/all.min.css" />
    <!-- <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/mycss.css" /> -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/style.css" />
</head>

<body>
    <div class="container flex-column">
        <div class="parent">
            <div class="main-menu">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="offcanvas" href="#" id="slide-menu-toggle"><i class="fa-solid fa-bars"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= base_url('home/home2'); ?>"><i class="fa-solid fa-house"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('transact'); ?>"><i class="fa-solid fa-cart-shopping"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-newspaper"></i></a>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="<?= base_url('home/setting'); ?>"><i class="fa-solid fa-gear"></i></a> -->
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-masks-theater"></i> <small class="font-size:0.2em" id="user-name-text">@<?= ucwords($user['name']); ?></small>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="<?= base_url('home/setting'); ?>">Setting</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <span><?= $title; ?></span>
            </div>
            <div class="slide-menu-toggle">
                <div class="offcanvas-header mb-3">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Slide Menu</h5>
                    <button type="button" class="btn-close" id="close-slide-menu" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="slide-menu-items">
                    <ul class="nav nav-side">
                        <li class="nav-item nav-item-side">
                            <a class="nav-link" data-bs-toggle="offcanvas" href="#" id="slide-menu-toggle"><i class="fa-solid fa-bars"></i></a>
                        </li>
                        <li class="nav-item nav-item-side">
                            <a class="nav-link" aria-current="page" href="<?= base_url('home/home2'); ?>"><i class="fa-solid fa-house"></i></a>
                        </li>
                        <li class="nav-item nav-item-side">
                            <a class="nav-link" href="<?= base_url('transact'); ?>"><i class="fa-solid fa-cart-shopping"></i></a>
                        </li>
                        <li class="nav-item nav-item-side">
                            <a class="nav-link" href="#"><i class="fa-solid fa-newspaper"></i></a>
                        </li>
                        <li class="nav-item nav-item-side">
                            <!-- <a class="nav-link" href="<?= base_url('home/setting'); ?>"><i class="fa-solid fa-gear"></i></a> -->
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-masks-theater"></i> <small class="font-size:0.2em" id="user-name-text">@<?= ucwords($user['name']); ?></small>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                        <hr>
                    </ul>
                    <ul class="list-group list-menutrx">
                        <li class="list-group-item"><a href="<?= base_url('transact/kasmasuk'); ?>" class=""><i class="fa-solid fa-cash-register"></i> Kas Masuk</a></li>
                        <li class="list-group-item"><a href="<?= base_url('transact/kaskeluar'); ?>" class=""><i class="fa-solid fa-file-invoice-dollar"></i> Kas Keluar</a></li>
                    </ul>
                    <hr>
                    <div class="card">
                        <div class="card-body">
                            <h5>Tambah agen baru</h5>
                            <form action="<?= base_url('home/tambahagen'); ?>" method="post">
                                <div class="mb-3">
                                    <label for="idagen" class="form-label">ID Agen</label>
                                    <input type="text" name="idagen" id="idagen" class="form-control form-control-sm" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="namaagen" class="form-label">Nama Agen</label>
                                    <input type="text" name="namaagen" id="namaagen" class="form-control form-control-sm" value="">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>