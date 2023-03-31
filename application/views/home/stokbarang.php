<div class="container list-stok-barang">
    <a href="<?= base_url('home/addItems'); ?>" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Add Items</a>
    <?php
    foreach ($provider as $p) {
    ?>
        <h4><?= $p['provider']; ?></h4>
        <?php $invent = $this->db->get_where('inventory', ['provider' => $p['provider']])->result_array();
        ?>
        <div class="card-list-stok-barang mb-3">
            <?php
            foreach ($invent as $inv) {
            ?>
                <div class="card card-stok-barang">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h1 class="jumlah-stok-barang"><?= number_format($inv['instock']); ?></h1>
                        <p class="kode-barang"><?= $inv['item_code']; ?></p>
                        <p class="nama-barang"><?= $inv['item_name']; ?></p>
                    </div>
                </div>
            <?php }; ?>
        </div>
    <?php }; ?>
</div>