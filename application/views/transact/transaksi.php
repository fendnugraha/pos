<?php error_reporting(0); ?>
<div class="container">
    <div class="row mt-3">
        <div class="col-sm-3">
            <div class="list-group">
                <a href="<?= base_url('transact'); ?>" class="list-group-item list-group-item-action active">Deposit / Trx</a>
                <a href="<?= base_url('transact/kasmasuk'); ?>" class="list-group-item list-group-item-action">Kas Masuk</a>
                <a href="<?= base_url('transact/kaskeluar'); ?>" class="list-group-item list-group-item-action">Kas Keluar</a>
                <a href="#" class="list-group-item list-group-item-action">Tukar Tunai</a>
            </div>
        </div>
        <div class="col-sm">
            <form action="<?= base_url('transact'); ?>" method="post">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Deposit
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
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
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jalur" id="irs" value="IRS" checked>
                                    <label class="form-check-label" for="irs">IRS</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jalur" id="okelink" value="OKELINK">
                                    <label class="form-check-label" for="okelink">OKELINK</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Pulsa & Data
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label for="produk" class="form-label">Produk</label>
                                        <input type="text" name="produk" id="produk" class="form-control form-control-sm" autocomplete="off">
                                    </div>
                                    <div class="col">
                                        <label for="tujuan" class="form-label">Tujuan</label>
                                        <input type="number" name="tujuan" id="tujuan" class="form-control form-control-sm" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control form-control-sm" placeholder="Harus diisi" autocomplete="off">
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