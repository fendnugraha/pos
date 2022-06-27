<?php error_reporting(0); ?>
<div class="container">
    <div class="row mt-3">
        <div class="col-sm-3">
            <div class="list-group">
                <a href="<?= base_url('transact'); ?>" class="list-group-item list-group-item-action active">Deposit</a>
                <a href="<?= base_url('transact/trxpulsa'); ?>" class="list-group-item list-group-item-action">Transaksi Pulsa</a>
                <a href="<?= base_url('transact/kasmasuk'); ?>" class="list-group-item list-group-item-action">Kas Masuk</a>
                <a href="<?= base_url('transact/kaskeluar'); ?>" class="list-group-item list-group-item-action">Kas Keluar</a>
                <a href="#" class="list-group-item list-group-item-action">Tukar Tunai</a>
            </div>
            <br>
            <?= validation_errors('<small class="text-danger pl-2">*', '</small>'); ?>
            <?= $this->session->flashdata('message'); ?>
        </div>
        <div class="col-sm-4">
            <div class="card mt-3">
                <div class="card-body">
                    <h2>FORM DEPOSIT</h2>
                    <form action="<?= base_url('transact'); ?>" method="post">
                        <div class="mb-3">
                            <label for="idagen" class="form-label">ID Agen/Kode</label>
                            <!-- <input type="text" name="idagen" id="idagen" class="form-control form-control-sm"> -->
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">ID</span>
                                <input type="text" class="form-control form-control-sm" placeholder="Input Angkanya saja!" aria-label="Input Angkanya saja!" name="idagen" id="idagen" aria-describedby="basic-addon1" autocomplete="off">
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

                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Deposit</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Bade ngisina sabaraha??" autocomplete="off">
                        </div>
                        <!-- <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text" name="keterangan" id="keterangan" class="form-control form-control-sm" placeholder="Opsional">
                                    </div> -->
                        <div class="mb-3 d-grid gap-2">
                            <button type="submit" class="btn btn-sm btn-primary mt-2">Submit</button>
                            <button data-id="<?= $lastRec['id']; ?>" class="cetak_struk_form btn btn-sm btn-success" <?php if (null == $lastRec['id']) {
                                                                                                                            echo "disabled";
                                                                                                                        }; ?>>
                                <i class="fas fa-print"></i> Cetak <?= $lastRec['idagen']; ?></button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-sm">
            <?php if ($lastRec['produk'] == "Isi Saldo Deposit") { ?>
                <div class="card mt-3 bg-dark text-warning">
                    <div class="card-body">
                        <h2 class="text-center"><em>"<?= $lastRec['produk']; ?>"</em></h2>
                        <h6>- <?= $lastRec['idagen']; ?> -</h6>
                        <h4 class="text-success text-end">Rp. <?= number_format($lastRec['jumlah']); ?></h4>
                    </div>
                    <div class="card-footer">
                        <h2 class="text-center text-primary"><?= "TL." . substr($lastRec['idagen'], 0, 6) . "." . $lastRec['jumlah'] . ".1";
                                                                ?></h2>
                    </div>
                <?php }; ?>
                </div>
        </div>
    </div>

</div>