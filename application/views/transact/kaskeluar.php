<?php error_reporting(0); ?>
<div class="container">
    <div class="row mt-3">
        <div class="col-sm-3">
            <div class="list-group">
                <a href="<?= base_url('transact'); ?>" class="list-group-item list-group-item-action">Deposit</a>
                <a href="<?= base_url('transact/trxpulsa'); ?>" class="list-group-item list-group-item-action">Transaksi Pulsa</a>
                <a href="<?= base_url('transact/kasmasuk'); ?>" class="list-group-item list-group-item-action">Kas Masuk</a>
                <a href="<?= base_url('transact/kaskeluar'); ?>" class="list-group-item list-group-item-action active">Kas Keluar</a>
                <a href="#" class="list-group-item list-group-item-action">Tukar Tunai</a>
            </div>
        </div>
        <div class="col-sm">
            <h1>Kas Keluar</h1>
            <hr>
            <form action="<?= base_url('transact/kaskeluar'); ?>" method="post">
                <div class="mb-3">
                    <!-- <label for="keterangan" class="form-label">Keterangan</label> -->
                    <input type="text" name="kaskeluar" id="kaskeluar" class="form-control form-control-sm" value=1 hidden readonly>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control form-control-sm" autocomplete="off">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="metodek" id="metodek1" value=0>
                    <label class="form-check-label" for="metodek1">
                        Saldo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="metodek" id="metodek2" value=1 checked>
                    <label class="form-check-label" for="metodek2">
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
                    <button type="submit" class="btn btn-sm btn-danger">Input Kas Keluar</button>
                </div>
            </form>
            <?= validation_errors('<small class="text-danger pl-2">*', '</small>'); ?>
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

</div>