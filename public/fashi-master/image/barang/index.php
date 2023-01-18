
<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container">

    <!-- flash message if success or fail -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php elseif (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('error') ?>
    </div>

    <?php endif; ?>
    <br><br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Form Barang</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('barang/create') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" class="form-control" name="harga" placeholder="Harga">
                        </div>
                        <div class="form-group ">
                            <label for="stok">Stok</label>
                            <input type="text" class="form-control" name="stok" placeholder="Stok">
                        </div>
                        <div class="form-group ">
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control" name="gambar">
                        </div>
                        <div class="form-group ">
                            <label for="id_kategori">Kategori</label>
                            <select name="id_kategori" class="form-control">
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($kategori as $k) : ?>
                                    <option value="<?= $k->id ?>"><?= $k->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><br><br>
<?= $this->endSection() ?>