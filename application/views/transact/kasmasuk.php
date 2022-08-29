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
            <a href="<?= base_url('transact/kasmasuk'); ?>" class="active"><i class="fa-solid fa-cash-register"></i> Kas Masuk</a>
            <a href="<?= base_url('transact/kaskeluar'); ?>" class=""><i class="fa-solid fa-file-invoice-dollar"></i> Kas Keluar</a>
            <a href="#" class=""><i class="fa-solid fa-money-bills"></i> Tukar Tunai</a>
        </div>
        <div class="col-sm">
            <h1>Kas Masuk</h1>
            <hr>
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
            <?= validation_errors('<small class="text-danger pl-2">*', '</small>'); ?>
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

</div>