<div class="container">
    <h1>Add Items</h1>
    <div class="card" style="width:50vw">
        <div class="card-body">
            <form action="<?= base_url('home/addItems'); ?>" class="row g-3 mb-3" method="post">
                <div class="col-md-4">
                    <label for="item_code">Item Code</label>
                    <input type="text" name="item_code" id="item_code" class="form-control">
                </div>
                <div class="col-md-8">
                    <label for="item_name">Item Name</label>
                    <input type="text" name="item_name" id="item_name" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="provider">Provider</label>
                    <select name="provider" id="provider" class="form-control">
                        <option value="AXIS">AXIS</option>
                        <option value="INDOSAT">INDOSAT</option>
                        <option value="SIMPATI">SIMPATI</option>
                        <option value="SMARTFREN">SMARTFREN</option>
                        <option value="THREE">THREE</option>
                        <option value="XL">XL</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="form-control">
                        <option value="Kartu Perdana">Kartu Perdana</option>
                        <option value="Voucher Fisik">Voucher Fisik</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="instock">In Stock</label>
                    <input type="number" name="instock" id="instock" class="form-control" value="0">
                </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-1">Submit</button>
    </form>
    <?= validation_errors('<small class="text-danger pl-2">*', '</small>'); ?>

</div>