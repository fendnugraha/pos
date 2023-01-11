<script src="<?= base_url('assets/js/'); ?>bootstrap.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>jquery-1.12.4.js"></script>
<script src="<?= base_url('assets/js/'); ?>jquery-ui.js"></script>
<script src="<?= base_url('assets/js/'); ?>jquery-3.4.1.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>all.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>fontawesome.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>datatables.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>popper.min.js"></script>
<script src="<?= base_url('assets/js/'); ?>myjs.js"></script>
<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }

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
                    document.location.href = "<?= base_url('home'); ?>";
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
                    document.location.href = "<?= base_url('home'); ?>";
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
                    document.location.href = "<?= base_url('home'); ?>";
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