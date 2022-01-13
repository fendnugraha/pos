<?php error_reporting(0); ?>
<div class="container">
    <div class="row mt-3">
        <div class="col-sm-3">
            <div class="list-group">
                <a href="<?= base_url('transact'); ?>" class="list-group-item list-group-item-action">Deposit</a>
                <a href="<?= base_url('transact/trxpulsa'); ?>" class="list-group-item list-group-item-action active">Transaksi Pulsa</a>
                <a href="<?= base_url('transact/kasmasuk'); ?>" class="list-group-item list-group-item-action">Kas Masuk</a>
                <a href="<?= base_url('transact/kaskeluar'); ?>" class="list-group-item list-group-item-action">Kas Keluar</a>
                <a href="#" class="list-group-item list-group-item-action">Tukar Tunai</a>
            </div>
        </div>
        <div class="col-sm">
            <div class="card mt-3">
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
            <?= validation_errors('<small class="text-danger pl-2">*', '</small>'); ?>
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

</div>