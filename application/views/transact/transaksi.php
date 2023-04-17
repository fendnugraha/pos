<?php error_reporting(0); ?>
<div class="container container-satu">
    <div class="side-menu-trx mt-3">
        <h4 class="text-center">Side Menu</h4>
        <hr>
        <ul class="list-menu-trx">
            <li>
                <a href="<?= base_url('transact'); ?>" class="active"><i class="fa-solid fa-money-bill-transfer"></i> Deposit</a>
            </li>
            <li>
                <a href="<?= base_url('transact/trxpulsa'); ?>" class=""><i class="fa-solid fa-mobile-retro"></i> Transaksi Pulsa</a>
            </li>
            <li>
                <a href="<?= base_url('transact/kasmasuk'); ?>" class=""><i class="fa-solid fa-cash-register"></i> Kas Masuk</a>
            </li>
            <li>
                <a href="<?= base_url('transact/kaskeluar'); ?>" class=""><i class="fa-solid fa-file-invoice-dollar"></i> Kas Keluar</a>
            </li>
            <li>
                <a href="#" class=""><i class="fa-solid fa-money-bills"></i> Tukar Tunai</a>
            </li>
        </ul>
    </div>
    <div class="mid-content mt-3">
        <div class="card">
            <div class="card-body">
                <h5>Input Deposit Agen</h5>
                <hr>
                <form action="<?= base_url('transact'); ?>" method="post">
                    <div class="mb-3 row">
                        <div class="col-sm-4">
                            <label for="idagen" class="form-label">ID Agen/Kode</label>
                            <input type="text" name="idagen" id="idagen" placeholder="Angkanya saja!" class="form-control" autocomplete="off" maxlength="5">
                            <!-- <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">ID Agen</span>
                                <input type="text" class="form-control" placeholder="Input Angkanya saja!" aria-label="Input Angkanya saja!" name="idagen" id="idagen" aria-describedby="basic-addon1" autocomplete="off" maxlength="5">
                            </div> -->
                        </div>
                        <div class="col-sm">
                            <label for="jumlah" class="form-label">Jumlah Deposit (Rp)</label>
                            <div class="col-sm">
                                <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Bade ngisina sabaraha??" autocomplete="off">
                            </div>
                        </div>

                    </div>
                    <!-- <div class="mb-3 row">
                        <label for="jumlah" class="form-label col-sm-5 col-form-label">Jumlah Deposit (Rp)</label>
                        <div class="col-sm">
                            <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Bade ngisina sabaraha??" autocomplete="off">
                        </div>
                    </div> -->
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
                        <div class="col-sm d-grid">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                        <div class="col-sm-3 d-grid">
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
                    <h4><?= $lastRec['idagen']; ?> Rp. <?= number_format($lastRec['jumlah']); ?></h4>

                    <?php
                    $id_agen = substr($lastRec['idagen'], 0, 6);
                    $datathr = $this->db->get_where('tb_thr', ['id_agen' => $id_agen]);
                    if ($datathr->num_rows() == 0) {
                        $dapat = "Maaf, <strong>Tidak dapat apa-apa <i class='fa-regular fa-face-frown'></i></strong>, mungkin tahun depan <span class='text-danger fst-italic'>(kalo maksa kasih Orson saja !!)</span>";
                    } else {
                        $datathr = $datathr->row_array();
                        if ($datathr['status'] == 1) {
                            $dapat = "<strong class='text-danger'><i class='fa-solid fa-gifts'></i> " . $datathr['paket'] . "</strong>-nya sudah diambil pada " . date('Y-m-d H:i:s', $datathr['diambil']) . " di <strong class='text-danger'>" . $datathr['lokasi'] . "</strong>.";
                        } else {
                            $dapat = "<strong>Selamat!!</strong> Anda mendapatkan <strong class='text-danger'><i class='fa-solid fa-gifts'></i> " . $datathr['paket'] . "</strong> di <strong class='text-danger'>" . $datathr['lokasi'] . "</strong>";
                        }
                    }
                    ?>
                    <p class="text-center mt-3">"<?= $dapat; ?>"</p>
                <?php }; ?>
            </div>
        </div>
        <?php if ($lastRec['produk'] == "Isi Saldo Deposit") {
            if ($lastRec['jalur'] == "IRS") {
                $awalan = "TL.";
            } else {
                $awalan = "ADD.";
            }
        ?>
            <div class="card bg-secondary text-warning mt-1">
                <div class="card-body p-1">
                    <h1 class="text-center text-warning fw-bold" id="text"><?= $awalan . "<span class='text-light'>" . preg_replace("/-/", "", substr($lastRec['idagen'], 0, 7)) . "</span>." . $lastRec['jumlah'] . ".1";
                                                                            ?></h1>
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-sm btn-warning btn-block" id="btn-copy" onclick="copyToClipboard('#text')"><i class="fa-solid fa-clipboard"></i> Click to Copy</button>
            </div>
        <?php }; ?>
    </div>
    <div class="side-menu-notif mt-3">
        <h5>Recent updates</h5>
        <div class="notification-input d-flex flex-column">
            <?php foreach ($recentdep as $rdep) {
                if ($rdep['jalur'] == "IRS") {
                    $awalan = "TL.";
                } else {
                    $awalan = "ADD.";
                } ?>
                <div class="card-notif">
                    <div class="card-notif-body bg-light">
                        <small class="text-muted"><?= $rdep['waktu'] ?> <?= ucwords($rdep['idagen']) ?></small>
                        <p class="mb-0"><?= ucwords($rdep['produk'] . " " . $rdep['keterangan']) . " Rp. " . number_format($rdep['jumlah']) . " (" . $rdep['kasir'] . ")"; ?></p>
                        <small class="text-muted"><?= $awalan . preg_replace("/-/", "", substr($rdep['idagen'], 0, 7)) . "." . $rdep['jumlah'] . ".1";
                                                    ?> </small>
                    </div>
                    <button data-id="<?= $rdep['id']; ?>" class="cetak_struk_form btn btn-sm btn-success btn-notif" <?php if (null == $rdep['id']) {
                                                                                                                        echo "disabled";
                                                                                                                    }; ?>>
                        <i class="fas fa-print"></i>
                    </button>
                </div>
            <?php } ?>
        </div>
        <br>
        <?= validation_errors('<small class="text-danger pl-2">*', '</small>'); ?>
        <?= $this->session->flashdata('message'); ?>
    </div>

</div>