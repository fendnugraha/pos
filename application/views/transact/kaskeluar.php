<?php error_reporting(0); ?>
<div class="container">
    <div class="row mt-3">
        <div class="col-sm-3 d-flex flex-column side-menu-trx">

            <!-- <div class="list-group list-group-flush submenu-list">
<a href="<?= base_url('transact'); ?>" class="list-group-item list-group-item-action active"><i class="fa-solid fa-money-bill-transfer"></i> Deposit</a>
<a href="<?= base_url('transact/trxpulsa'); ?>" class="list-group-item list-group-item-action"><i class="fa-solid fa-mobile-retro"></i> Transaksi Pulsa</a>
<a href="<?= base_url('transact/kasmasuk'); ?>" class="list-group-item list-group-item-action"><i class="fa-solid fa-cash-register"></i> Kas Masuk</a>
<a href="<?= base_url('transact/kaskeluar'); ?>" class="list-group-item list-group-item-action"><i class="fa-solid fa-file-invoice-dollar"></i> Kas Keluar</a>
<a href="#" class="list-group-item list-group-item-action"><i class="fa-solid fa-money-bills"></i> Tukar Tunai</a>
</div> -->
            <a href="<?= base_url('transact'); ?>" class=" "><i class="fa-solid fa-money-bill-transfer"></i> Deposit</a>
            <a href="<?= base_url('transact/trxpulsa'); ?>" class=""><i class="fa-solid fa-mobile-retro"></i> Transaksi Pulsa</a>
            <a href="<?= base_url('transact/kasmasuk'); ?>" class=""><i class="fa-solid fa-cash-register"></i> Kas Masuk</a>
            <a href="<?= base_url('transact/kaskeluar'); ?>" class="active"><i class="fa-solid fa-file-invoice-dollar"></i> Kas Keluar</a>
            <a href="#" class=""><i class="fa-solid fa-money-bills"></i> Tukar Tunai</a>
        </div>
        <div class="col-sm-4">
            <h1>Kas Keluar</h1>
            <hr>
            <form action="<?= base_url('transact/kaskeluar'); ?>" method="post">
                <div class="mb-3">
                    <!-- <label for="keterangan" class="form-label">Keterangan</label> -->
                    <input type="text" name="kaskeluar" id="kaskeluar" class="form-control" value=1 hidden readonly>
                </div>
                <div class="mb-3">
                    <label for="nobukti" class="form-label">Nomor Bukti</label>
                    <input type="text" name="nobukti" id="nobukti" class="form-control" autocomplete="off">
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
        <div class="col-sm">
            <div class="card mt-3 bg-dark text-warning">
                <div class="card-body">
                    <h2 class="text-center"><em>"<?= $lastRec['keterangan']; ?>"</em></h2>
                    <h6>- <?= $lastRec['idagen']; ?> -</h6>
                    <h4 class="text-success text-end">Rp. <?= number_format($lastRec['jumlah']); ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>