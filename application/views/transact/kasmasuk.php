<?php error_reporting(0); ?>
<div class="container container-satu">
    <div class="side-menu-trx mt-3">
        <h4>Side Menu</h4>
        <ul class="list-menu-trx">
            <li>
                <a href="<?= base_url('transact'); ?>" class=""><i class="fa-solid fa-money-bill-transfer"></i> Deposit</a>
            </li>
            <li>
                <a href="<?= base_url('transact/trxpulsa'); ?>" class=""><i class="fa-solid fa-mobile-retro"></i> Transaksi Pulsa</a>
            </li>
            <li>
                <a href="<?= base_url('transact/kasmasuk'); ?>" class="active"><i class="fa-solid fa-cash-register"></i> Kas Masuk</a>
            </li>
            <li>
                <a href="<?= base_url('transact/kaskeluar'); ?>" class=""><i class="fa-solid fa-file-invoice-dollar"></i> Kas Keluar</a>
            </li>
            <li>
                <a href="#" class=""><i class="fa-solid fa-money-bills"></i> Tukar Tunai</a>
            </li>
        </ul>
    </div>
    <div class="mid-content mt-3">
        <h4>Kas Masuk</h4>
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('transact/kasmasuk'); ?>" method="post">
                    <div class="mb-3">
                        <!-- <label for="keterangan" class="form-label">Keterangan</label> -->
                        <input type="text" name="kasmasuk" id="kasmasuk" class="form-control form-control-sm" value=1 hidden readonly>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control form-control-sm" autocomplete="off">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="metodem" id="metodem1" value=0 checked>
                        <label class="form-check-label" for="metodem1">
                            Saldo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="metodem" id="metodem2" value=1>
                        <label class="form-check-label" for="metodem2">
                            Kas/Tunai
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control form-control-sm" autocomplete="off">
                    </div>
                    <div class="form-check form-check-inline mb-3">
                        <input class="form-check-input" type="radio" name="jalur" id="irs" value="IRS" checked>
                        <label class="form-check-label" for="irs">IRS</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jalur" id="okelink" value="OKELINK">
                        <label class="form-check-label" for="okelink">OKELINK</label>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-sm btn-success">Input Kas Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="side-menu-notif mt-3">
        <h2>Recent updates</h2>
        <div class="notification-input d-flex flex-column">
            <?php foreach ($recentkas as $rkas) { ?>
                <div class="card-notif">
                    <div class="card-notif-body">
                        <small class="text-muted"><?= $rkas['tujuan'] ?></small>
                        <p class="mb-0"><span class="fw-bold"><?= $rkas['waktu'] ?></span><?= ucwords($rkas['keterangan']) . " Rp. " . number_format($rkas['jumlah']); ?></p>
                        <small class="text-muted">Penerima: <?= ucwords($rkas['idagen']) ?> Kasir: <?= ucwords($rkas['kasir']) ?></small>
                    </div>
                    <button data-id="<?= $rkas['id']; ?>" class="cetak_struk btn btn-sm btn-success btn-notif" <?php if (null == $rkas['id']) {
                                                                                                                    echo "disabled";
                                                                                                                }; ?>>
                        <i class="fas fa-print"></i>
                    </button>
                </div>
            <?php } ?>
        </div>

        <br>
        <?= validation_errors('<small class="text-danger pl-2">*', '</small>'); ?>
        <?= $this->session->flashdata('message'); ?>
    </div>

</div>