<?php error_reporting(0); ?>
<div class="container mt-5">
    <h1>THR AGEN</h1>
    <div class="card">
        <div class="card-body">
            <table class="table display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Agen</th>
                        <th>Nama</th>
                        <th>Paket</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($tb_thr as $t) {
                        if ($t['status'] == 1) {
                            $checked = "checked";
                            $disabled = "disabled";
                        } else {
                            $checked = "";
                            $disabled = "";
                        }

                        if ($t['diambil'] == 0) {
                            $diambil = "Belum Diambil";
                        } else {
                            $diambil = "Sudah Diambil @" . date('Y-m-d H:i:s', $t['diambil']);
                        };
                    ?>
                        <tr>
                            <td><?= $t['id']; ?></td>
                            <td><?= $t['id_agen']; ?></td>
                            <td><?= $t['name']; ?></td>
                            <td><?= $t['paket']; ?></td>
                            <td><?= $t['lokasi']; ?></td>
                            <td class="text-center">
                                <div class="form-check">
                                    <input class="form-check-input status_thr js-single" type="checkbox" value="" id="defaultCheck1" <?= $checked; ?> data-idagen="<?= $t['id_agen']; ?>">
                                    <label class="form-check-label" for="defaultCheck1"><?= $diambil; ?>
                                    </label>
                                </div>
                            </td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>