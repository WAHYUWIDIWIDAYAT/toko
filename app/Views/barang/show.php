<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<br><br>
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
                    <h3 class="float-left">Daftar Barang</h3>
                    <a href="<?= base_url('/barang/create') ?>" class="btn btn-primary float-right">Tambah Barang</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Kategori</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($barang as $key => $value) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value->nama ?></td>
                                    <td><?= $value->harga ?></td>
                                    <td><?= $value->stok ?></td>
                                    <?php foreach ($kategori as $k) : ?>
                                        <?php if ($k->id == $value->id_kategori) : ?>
                                            <td><?= $k->nama ?></td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <td><img src="<?= base_url('uploads/' . $value->gambar) ?>" alt="" width="100px"></td>
                                    <td>
                                        <a href="<?= base_url('edit/barang/' . $value->id) ?>" class="btn btn-warning">Edit</a>
                                        <form action="<?= base_url('delete/barang/' . $value->id) ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Delete</button>
                                        </form>
                                        <a href="<?= base_url('detail/barang/' . $value->id) ?>" class="btn btn-info">Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<?= $this->endSection() ?>