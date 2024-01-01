<div class="card user-login">
    <div class="card-body d-flex justify-content-center align-items-center">
        <!-- <h2><i class="fa-solid fa-masks-theater"></i> @fendnugraha</h2> -->
        <a class="user-name text-decoration-none">
            <?= $setting['namakonter']; ?>
        </a>
    </div>
</div>
<div class="card latest-input">
    <div class="card-body overflow-x-auto">
        <?php foreach ($recentdep as $rdep) {
            if ($rdep['jalur'] == "IRS") {
                $awalan = "TL.";
            } else {
                $awalan = "ADD.";
            } ?>
            <div class="latest-post border-bottom pb-2 mb-2">
                <div class="d-flex justify-content-between >
                    <small class=" text-muted d-block" style="font-size: 0.7em;"><?= $rdep['waktu'] ?> | <?= ucwords($rdep['idagen']) ?> </small>

                    <?php if ($rdep['status'] == "Out" && $rdep['metode'] == 1) {
                    ?>
                        <button data-id="<?= $rdep['id']; ?>" class="cetak_kas_keluar btn btn-sm btn-danger"><i class="fa-solid fa-print"></i> Print</button>
                    <?php } else {; ?>
                        <button data-id="<?= $rdep['id']; ?>" class="cetak_struk btn btn-sm btn-success"><i class="fa-solid fa-print"></i> Print</button>
                    <?php } ?>
                </div>
                <p class=" mb-0" style="font-size: 1em;"><?= ucwords($rdep['produk'] . " " . $rdep['keterangan']) . " <sup>Rp</sup>" . number_format($rdep['jumlah']); ?></p>
                <p class="mb-0" style="font-size: 0.8em;" <?php if ($rdep['produk'] == "---") {
                                                                echo "hidden";
                                                            }; ?>>

                    <?= $awalan . preg_replace("/-/", "", substr($rdep['idagen'], 0, 7)) . "." . $rdep['jumlah'] . ".1";
                    ?>

                </p>
                <span class="badge text-bg-warning"><?= $rdep['kasir']; ?></span>
                <span class="badge text-bg-dark"><?= $rdep['jalur']; ?></span>

            </div>
        <?php } ?>
    </div>
</div>
</div>
</div>


<script src="<?= base_url('assets'); ?>/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/jquery-3.7.0.js"></script>
<script src="<?= base_url('assets'); ?>/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/jquery-ui.js"></script>
<script src="<?= base_url('assets'); ?>/js/fontawesome.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/all.min.js"></script>
<!-- <script src="<?= base_url('assets'); ?>/js/myjs.js"></script> -->
<script src="<?= base_url('assets/js/'); ?>myjs.js"></script>
<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }

    $("#idagen").autocomplete({
        source: '<?= base_url('transact/cariAgen'); ?> ',
        minLength: 2
    });

    $('.status_thr').on('click', function() {
        // console.log('ok');
        const idagen = $(this).data('idagen');

        $.ajax({
            url: '<?= base_url('home/changestatusthr'); ?>',
            type: 'post',
            data: {
                idagen: idagen,
            },

            success: function() {
                // alert('Access has been changed !');
                document.location.href = "<?= base_url('home/thr/'); ?>";

            }
        });
    });


    $("button#btn-copy").click(function() {
        $(this).html("<i class='fa-solid fa-clipboard'></i> Text Copied!");
        $(this).addClass("btn-success");
        $(this).removeClass("btn-warning");
        // console.log("berhasil");
    });

    $('.cetak_struk').on('click', function(e) {
        const transferId = $(this).data('id');

        e.preventDefault()
        if (confirm('Cetak transaksi ID ' + transferId + ' ?')) {
            $.ajax({
                type: 'post',
                url: "<?= base_url('home/faktur_print'); ?>",
                data: {
                    transferId: transferId,
                },
                success: function() {
                    document.location.href = "<?= base_url('home/home2'); ?>";
                }
            });
        }
    });

    $('.cetak_struk_form').on('click', function(e) {
        const transferId = $(this).data('id');

        e.preventDefault()
        if (confirm('Cetak transaksi ID ' + transferId + ' ?')) {
            $.ajax({
                type: 'post',
                url: "<?= base_url('home/faktur_print'); ?>",
                data: {
                    transferId: transferId,
                },
                success: function() {
                    document.location.href = "<?= base_url('transact'); ?>";
                }
            });
        }
    });

    $('.cetak_kas_keluar').on('click', function(e) {
        const transferId = $(this).data('id');

        e.preventDefault()
        if (confirm('Cetak transaksi ID ' + transferId + ' ?')) {
            $.ajax({
                type: 'post',
                url: "<?= base_url('home/kas_keluar_cetak'); ?>",
                data: {
                    transferId: transferId,
                },
                success: function() {
                    document.location.href = "<?= base_url('home/home2'); ?>";
                }
            });
        }
    });

    $('.hapus_record').on('click', function(e) {
        const transferId = $(this).data('id');
        e.preventDefault()
        if (confirm('Hapus transaksi ID ' + transferId + ' ?')) {
            $.ajax({
                type: 'post',
                url: "<?= base_url('home/hapus_record'); ?>",
                data: {
                    transferId: transferId,
                },
                success: function() {
                    document.location.href = "<?= base_url('home/home2'); ?>";
                }
            });
        }
    });
    $('.cetak-laporan').on('click', function(e) {
        const tanggal = $(this).data('id');

        e.preventDefault()
        if (confirm('Cetak laporan ' + tanggal + ' ?')) {
            $.ajax({
                type: 'post',
                url: "<?= base_url('home/dailyReport'); ?>",
                data: {
                    tanggal: tanggal,
                },
                success: function() {
                    document.location.href = "<?= base_url('home/report'); ?>";
                }
            });
        }
    });
</script>