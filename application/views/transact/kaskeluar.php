<?php error_reporting(0); ?>
<div class="container container-satu">
    <div class="side-menu-trx mt-3">
        <a href="<?= base_url('transact'); ?>" class=" "><i class="fa-solid fa-money-bill-transfer"></i> Deposit</a>
        <a href="<?= base_url('transact/trxpulsa'); ?>" class=""><i class="fa-solid fa-mobile-retro"></i> Transaksi Pulsa</a>
        <a href="<?= base_url('transact/kasmasuk'); ?>" class=""><i class="fa-solid fa-cash-register"></i> Kas Masuk</a>
        <a href="<?= base_url('transact/kaskeluar'); ?>" class="active"><i class="fa-solid fa-file-invoice-dollar"></i> Kas Keluar</a>
        <a href="#" class=""><i class="fa-solid fa-money-bills"></i> Tukar Tunai</a>
    </div>
    <div class="mid-content mt-3">
        <h4>Kas Keluar</h4>
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('transact/kaskeluar'); ?>" method="post">
                    <div class="mb-3">
                        <!-- <label for="keterangan" class="form-label">Keterangan</label> -->
                        <input type="text" name="kaskeluar" id="kaskeluar" class="form-control" value=1 hidden readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nobukti" class="form-label">Nomor Bukti</label>
                        <input type="text" name="nobukti" id="nobukti" class="form-control" autocomplete="off" value="<?= $nobukti; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="metodek" id="metodek1" value=0>
                        <label class="form-check-label" for="metodek1">
                            Saldo
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="metodek" id="metodek2" value=1 checked>
                        <label class="form-check-label" for="metodek2">
                            Kas/Tunai
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="penerima" class="form-label">Penerima</label>
                        <input type="text" name="penerima" id="penerima" class="form-control" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-check form-check-inline mb-3">
                        <input class="form-check-input" type="radio" name="jalur" id="irs" value="IRS" checked>
                        <label class="form-check-label" for="irs">IRS</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jalur" id="okelink" value="OKELINK">
                        <label class="form-check-label" for="okelink">OKELINK</label>
                    </div>
                    <div class="mb-3 d-grid gap-2">
                        <button type="submit" class="btn btn-sm btn-primary mt-2">Submit</button>
                        <button data-id="<?= $lastRec['id']; ?>" class="cetak_kas_keluar btn btn-sm btn-success" <?php if (null == $lastRec['id']) {
                                                                                                                        echo "disabled";
                                                                                                                    }; ?>>
                            <i class="fas fa-print"></i> Cetak <?= $lastRec['tujuan']; ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="side-menu-notif mt-3">
        <h2>Recent updates</h2>
        <?php foreach ($recentkas as $rkas) { ?>
            <div class="notification-input d-flex mb-1">
                <div class="card-notif">
                    <small class="text-muted"><?= $rkas['tujuan'] ?></small>
                    <p class="mb-0"><span class="fw-bold"><?= $rkas['waktu'] ?></span><?= ucwords($rkas['keterangan']) . " Rp. " . number_format($rkas['jumlah']); ?></p>
                    <small class="text-muted">Penerima: <?= ucwords($rkas['idagen']) ?> Kasir: <?= ucwords($rkas['kasir']) ?></small>
                </div>
                <button data-id="<?= $rkas['id']; ?>" class="cetak_kas_keluar btn btn-sm btn-success btn-notif" <?php if (null == $rkas['id']) {
                                                                                                                    echo "disabled";
                                                                                                                }; ?>>
                    <i class="fas fa-print"></i>
                </button>
            </div>
        <?php } ?>

        <br>
        <?= validation_errors('<small class="text-danger pl-2">*', '</small>'); ?>
        <?= $this->session->flashdata('message'); ?>
    </div>

</div>