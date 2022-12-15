
<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<br><br>
<?php

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
</form>
<?= $this->endSection() ?>