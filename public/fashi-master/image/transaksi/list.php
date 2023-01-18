<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container">
    <br><br>
    <div class="row">
        <div class="col-12">
            <div class="wishlist-table table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="pro-thumbnail">No</th>
                            <th class="pro-thumbnail">Nama Barang</th>
                            <th class="pro-stock">Nama Pembeli</th>
                            <th class="pro-stock">Jumlah</th>
                            <th class="pro-stock">Total</th>
                            <th class="pro-stock">Status</th>
                            <th class="pro-stock">Alamat</th>
                            <th class="pro-stock">Ongkir</th>
                            <th class="pro-stock">Action</th>
                        </tr>
                    </thead>
                    <?php if (isset($transaksi)) : ?>
                        <?php $no = 1; ?>
                        <?php foreach ($transaksi as $key => $value) : ?>
                            <tbody>
                            <tr>
                                        <td class="pro-thumbnail"><?= $no++ ?></td>
                                    
                                        <?php foreach ($barangs as $key => $value2) : ?>
                                            <?php if ($value->id_barang == $value2->id) : ?>
                                                <td class="pro-thumbnail"><?= $value2->nama ?></td>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php foreach ($users as $key => $value3) : ?>
                                            <?php if ($value->id_pembeli == $value3->id) : ?>
                                                <td class="pro-thumbnail"><?= $value3->username ?></td>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        
                                        <td class="pro-stock"><span><?= $value->jumlah ?></span></td>
                                        <td class="pro-stock"><span><?= $value->total_harga ?></span></td>
                                        <td class="pro-stock"><span><?= $value->status ?></span></td>
                                        <td class="pro-stock"><span><?= $value->alamat ?></span></td>
                                        <td class="pro-stock"><span><?= $value->ongkir ?></span></td>
                                        <td class="pro-stock text-center">
                                            <form action="<?= base_url('transaksi/update') ?>" method="post">
                                                <input type="hidden" name="id" value="<?= $value->id ?>">
                                                <input type="hidden" name="status" value="dikirim">
                                                <button type="submit" class="btn btn-success">Dikirim</button>
                                            </form>
                                        </td>
                                    </tr>
                            </tbody>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>