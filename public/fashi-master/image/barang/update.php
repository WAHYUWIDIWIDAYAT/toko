<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!--make beautiful form for update barang-->
<div class="container">
    <?php
        $session = session(); 
        if(session()->getFlashdata('success')){
            echo '<div class="alert alert-success" role="alert">';
            echo session()->getFlashdata('success');
            echo '</div>';
        }
    ?>
    <br><br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Form Update Barang</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('edit/barang/'.$barang->id) ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?= $barang->nama?>">
                        </div>
                        <div class="form-group ">
                            <label for="kategori">Kategori</label>
                            <select class="form-control" name="kategori" id="kategori">
                                <?php foreach($kategori as $k): ?>
                                    <option value="<?= $k->id ?>" <?= $k->id == $barang->id_kategori ? 'selected' : '' ?>><?= $k->nama ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label for="harga">Harga</label>
                            <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?= $barang->harga ?>">
                        </div>
                        <div class="form-group ">
                            <label for="stok">Stok</label>
                            <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?= $barang->stok ?>">
                        </div>
                        <div class="form-group ">
                            <label for="gambar">Gambar</label>
                            <input type="hidden" name="gambarLama" id="gambarLama" value="<?= $barang->gambar ?>">
                            <input type="file" class="form-control" name="gambar">
                            
                        </div>
                        <br>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><br><br>

<?= $this->endSection() ?>