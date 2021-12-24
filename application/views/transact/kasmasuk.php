<?php error_reporting(0); ?>
<div class="container">
    <div class="row mt-3">
        <div class="col-sm-3">
            <div class="list-group">
                <a href="<?= base_url('transact'); ?>" class="list-group-item list-group-item-action">Deposit / Trx</a>
                <a href="<?= base_url('transact/kasmasuk'); ?>" class="list-group-item list-group-item-action active">Kas Masuk</a>
                <a href="<?= base_url('transact/kaskeluar'); ?>" class="list-group-item list-group-item-action">Kas Keluar</a>
                <a href="#" class="list-group-item list-group-item-action">Tukar Tunai</a>
            </div>
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
                    <input type="text" name="keterangan" id="keterangan" class="form-control form-control-sm">
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
                    <input type="number" name="jumlah" id="jumlah" class="form-control form-control-sm">
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