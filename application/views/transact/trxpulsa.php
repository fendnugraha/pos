<?php error_reporting(0); ?>
<div class="container container-satu">
    <div class="side-menu-trx mt-3">
        <a href="<?= base_url('transact'); ?>" class=" "><i class="fa-solid fa-money-bill-transfer"></i> Deposit</a>
        <a href="<?= base_url('transact/trxpulsa'); ?>" class="active"><i class="fa-solid fa-mobile-retro"></i> Transaksi Pulsa</a>
        <a href="<?= base_url('transact/kasmasuk'); ?>" class=""><i class="fa-solid fa-cash-register"></i> Kas Masuk</a>
        <a href="<?= base_url('transact/kaskeluar'); ?>" class=""><i class="fa-solid fa-file-invoice-dollar"></i> Kas Keluar</a>
        <a href="#" class=""><i class="fa-solid fa-money-bills"></i> Tukar Tunai</a>
    </div>
    <div class="mid-content mt-3">
        <h4>Kas Keluar</h4>
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('transact/trxpulsa'); ?>" method="post">
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="produk" class="form-label">Produk</label>
                            <input type="text" name="produk" id="produk" class="form-control" placeholder="Kode produk" autocomplete="off">
                        </div>
                        <div class="col">
                            <label for="tujuan" class="form-label">Tujuan</label>
                            <input type="number" name="tujuan" id="tujuan" class="form-control" placeholder="Nomor customer" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="cash" name="cash" value=3 checked>
                        <label class="form-check-label" for="cash" id="label-cash">
                            Cash/Tunai
                        </label>
                    </div>
                    <div class="form-check form-check-inline mb-3">
                        <input class="form-check-input" type="radio" name="jalur" id="irs" value="IRS">
                        <label class="form-check-label" for="irs">IRS</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jalur" id="okelink" value="OKELINK" checked>
                        <label class="form-check-label" for="okelink">OKELINK</label>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Harga jual produk yang ada diaplikasi" autocomplete="off">
                    </div>
                    <!-- <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text" name="keterangan" id="keterangan" class="form-control form-control-sm" placeholder="Opsional">
                                    </div> -->
            </div>
        </div>
        <div class="mb-3 d-grid gap-2">
            <button type="submit" class="btn btn-sm btn-primary mt-2">Submit</button>
            <button data-id="<?= $lastRec['id']; ?>" class="cetak_struk btn btn-sm btn-success" <?php if (null == $lastRec['id']) {
                                                                                                    echo "disabled";
                                                                                                }; ?>>
                <i class="fas fa-print"></i> Cetak <?= $lastRec['idagen']; ?></button>
        </div>
        </form>
    </div>
    <div class="side-menu-notif mt-3">
        <h2>Recent updates</h2>
        <?php foreach ($recentpulsa as $rpul) { ?>
            <div class="notification-input d-flex mb-1">
                <div class="card-notif">
                    <small class="text-muted"><?= $rpul['tujuan'] ?></small>
                    <p class="mb-0"><span class="fw-bold"><?= $rpul['waktu'] ?></span><?= ucwords($rpul['produk']) . " Rp. " . number_format($rpul['jumlah']); ?></p>
                    <small class="text-muted">Penerima: <?= ucwords($rpul['idagen']) ?> Kasir: <?= ucwords($rpul['kasir']) ?></small>
                </div>
                <button data-id="<?= $rpul['id']; ?>" class="cetak_kas_keluar btn btn-sm btn-success btn-notif" <?php if (null == $rpul['id']) {
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