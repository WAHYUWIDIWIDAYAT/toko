
<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- <?php

    $session = session(); 
    if(session()->getFlashdata('success')){
        echo '<div class="alert alert-success" role="alert">';
        echo session()->getFlashdata('success');
        echo '</div>';
    }

?>


<form action="<?= base_url('/kategori/create') ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nama_barang">Nama Kategori</label>
        <input type="text" class="form-control" name="nama" placeholder="Nama">
    </div>
    <input type="hidden" name="created_by" value="<?= $session->get('id') ?>">
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form> -->


<div class="container">
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
    <!--get list kategori-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>List Kategori</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($kategori as $k) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $k->nama ?></td>
                                    <td><?= $k->created_by ?></td>
                                    <td>
                                        <a href="<?= base_url('/kategori/edit/' . $k->id) ?>" class="btn btn-warning">Edit</a>
                                        <a href="<?= base_url('/kategori/delete/' . $k->id) ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Form Kategori</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('/kategori/create') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama_barang">Nama Kategori</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama">
                        </div>
                        <input type="hidden" name="created_by" value="<?= $session->get('id') ?>">
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