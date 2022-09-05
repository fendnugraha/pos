<?php error_reporting(0); ?>
<div class="container container-satu">
    <div class="side-menu-trx mt-3">
        <a href="<?= base_url('transact'); ?>" class="active"><i class="fa-solid fa-money-bill-transfer"></i> Deposit</a>
        <a href="<?= base_url('transact/trxpulsa'); ?>" class=""><i class="fa-solid fa-mobile-retro"></i> Transaksi Pulsa</a>
        <a href="<?= base_url('transact/kasmasuk'); ?>" class=""><i class="fa-solid fa-cash-register"></i> Kas Masuk</a>
        <a href="<?= base_url('transact/kaskeluar'); ?>" class=""><i class="fa-solid fa-file-invoice-dollar"></i> Kas Keluar</a>
        <a href="#" class=""><i class="fa-solid fa-money-bills"></i> Tukar Tunai</a>
    </div>
    <div class="mid-content mt-3">
        <h4>Input Deposit Agen</h4>
        <div class="card mt-3">
            <div class="card-body">
                <form action="<?= base_url('transact'); ?>" method="post">
                    <div class="mb-3">
                        <label for="idagen" class="form-label">ID Agen/Kode</label>
                        <!-- <input type="text" name="idagen" id="idagen" class="form-control form-control-sm"> -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">ID</span>
                            <input type="text" class="form-control form-control-sm" placeholder="Input Angkanya saja!" aria-label="Input Angkanya saja!" name="idagen" id="idagen" aria-describedby="basic-addon1" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jumlah" class="form-label col-sm-5 col-form-label">Jumlah Deposit (Rp)</label>
                        <div class="col-sm">
                            <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Bade ngisina sabaraha??" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="cash" name="cash" value=3 checked>
                        <label class="form-check-label" for="cash" id="label-cash">
                            Cash/Tunai
                        </label>
                    </div>
                    <div class="form-check form-check-inline mb-3">
                        <input class="form-check-input" type="radio" name="jalur" id="irs" value="IRS" checked>
                        <label class="form-check-label" for="irs">IRS</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jalur" id="okelink" value="OKELINK">
                        <label class="form-check-label" for="okelink">OKELINK</label>
                    </div>

                    <!-- <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text" name="keterangan" id="keterangan" class="form-control form-control-sm" placeholder="Opsional">
                                    </div> -->
                    <div class="mb-3 row">
                        <div class="col-sm d-grid gap-2">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                        <div class="col-sm-3 d-grid gap-2">
                            <button data-id="<?= $lastRec['id']; ?>" class="cetak_struk_form btn btn-sm btn-success" <?php if (null == $lastRec['id']) {
                                                                                                                            echo "disabled";
                                                                                                                        }; ?>>
                                <i class="fas fa-print"></i> Print</button>
                            <!-- <?= $lastRec['idagen']; ?> -->
                        </div>
                    </div>
                </form>
                <?php if ($lastRec['produk'] == "Isi Saldo Deposit") { ?>
                    <small class="text-muted"><?= $lastRec['waktu']; ?></small>
                    <h6><?= $lastRec['idagen']; ?> Rp. <?= number_format($lastRec['jumlah']); ?></h6>
                <?php }; ?>
            </div>
        </div>
        <?php if ($lastRec['produk'] == "Isi Saldo Deposit") { ?>
            <div class="card mt-3 bg-dark text-warning">
                <div class="card-body p-1">
                    <h2 class="text-center text-warning"><?= "TL." . preg_replace("/-/", "", substr($lastRec['idagen'], 0, 7)) . "." . $lastRec['jumlah'] . ".1";
                                                            ?></h2>
                </div>
            </div>
        <?php }; ?>
    </div>
    <div class="side-menu-notif mt-3">
        <h4>Recent updates</h4>
        <?php foreach ($recentdep as $rdep) { ?>
            <div class="notification-input d-flex mb-1">
                <div class="card-notif">
                    <small class="text-muted"><?= $rdep['waktu'] ?> <?= ucwords($rdep['idagen']) ?></small>
                    <p class="mb-0"><?= ucwords($rdep['produk'] . " " . $rdep['keterangan']) . " Rp. " . number_format($rdep['jumlah']) . " (" . $rdep['kasir'] . ")"; ?></p>
                    <small class="text-muted"><?= "TL." . preg_replace("/-/", "", substr($rdep['idagen'], 0, 7)) . "." . $rdep['jumlah'] . ".1";
                                                ?> </small>
                </div>
                <button data-id="<?= $rdep['id']; ?>" class="cetak_kas_keluar btn btn-sm btn-success btn-notif" <?php if (null == $rdep['id']) {
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