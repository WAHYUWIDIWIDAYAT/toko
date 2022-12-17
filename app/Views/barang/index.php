
<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<form action="<?= base_url('barang/create') ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nama_barang">Nama Barang</label>
        <input type="text" class="form-control" name="nama" placeholder="Nama">
    </div>
    <div class="form-group">
        <label for="harga">Harga</label>
        <input type="text" class="form-control" name="harga" placeholder="Harga">
    </div>
    <div class="form-group">
        <label for="stok">Stok</label>
        <input type="text" class="form-control" name="stok" placeholder="Stok">
    </div>
    <div class="form-group">
        <label for="gambar">Gambar</label>
        <input type="file" class="form-control" name="gambar">
    </div>
    <!--kategori input from data kategori-->
    <div class="form-group">
        <label for="id_kategori">Kategori</label>
        
        <select name="id_kategori" class="form-control">
        <option value="">Pilih Kategori</option>
            <?php foreach ($kategori as $k) : ?>
                <option value="<?= $k->id ?>"><?= $k->nama ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <!-- get data voucher from tabel voucher -->
    <?php foreach ($voucher as $voucher) : ?>
        <option value="<? $voucher->id ?>"><?= $voucher->nama ?></option>
        <?php endforeach;?>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
<?= $this->endSection() ?>