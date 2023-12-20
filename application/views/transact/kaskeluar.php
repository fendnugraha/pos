<?php error_reporting(0); ?>

<div class="main-page">
    <div class="card" style="height: 100%;">
        <div class="card-body">
            <h4>Kas Keluar</h4>
            <form action="<?= base_url('transact/kaskeluar'); ?>" method="post">
                <div class="mb-3">
                    <!-- <label for="keterangan" class="form-label">Keterangan</label> -->
                    <input type="text" name="kaskeluar" id="kaskeluar" class="form-control" value=1 hidden readonly>
                </div>
                <input type="text" name="nobukti" id="nobukti" class="form-control" autocomplete="off" value="<?= $nobukti; ?>" hidden>
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