
<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container">
    <br>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Detail Barang</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <img src="<?= base_url('uploads/'.$barang->gambar) ?>" alt="" class="img-fluid">
                        </div>
                        <div class="col-6">
                            <table class="table table-striped">
                                <tr>
                                    <td>Nama Barang</td>
                                    <td><?= $barang->nama ?></td>
                                </tr>
                                <?php foreach($kategori as $k) : ?>
                                    <?php if($k->id == $barang->id_kategori) : ?>
                                        <tr>
                                            <td>Kategori</td>
                                            <td><?= $k->nama ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <tr>
                                    <td>Harga</td>
                                    <td><?= $barang->harga ?></td>
                                </tr>
                                <tr>
                                    <td>Stok</td>
                                    <td><?= $barang->stok ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>


<?= $this->endSection() ?>