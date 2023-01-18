<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Wishlist Content -->
<!--make me beautiful list for whislist-->
<div class="container">
    <br><br>
    <div class="row">
        <div class="col-12">
            <div class="wishlist-table table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="pro-thumbnail">Image</th>
                            <th class="pro-title">Product</th>
                            <th class="pro-price">Price</th>
                            <th class="pro-stock">Stock Status</th>
                            <th class="pro-remove">Remove</th>
                        </tr>
                    </thead>
                    <?php if (isset($wishlist)) : ?>
                        <?php foreach ($wishlist as $key => $value) : ?>
                            <tbody>
                            <tr>
                                        <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="<?= base_url('uploads/' . $value->gambar) ?>" alt="Product" width="100px" height="100px"></a></td>
                                        <td class="pro-title"><?= $value->nama ?></a></td>
                                        <td class="pro-price"><span><?= $value->harga ?></span></td>
                                        <td class="pro-stock"><span><?= $value->stok ?></span></td>
                                        <!-- <form action="<?= base_url('shop/removewishlist/' . $value->id) ?>" method="post"> -->
                                        <form action="<?= base_url('shop/removewishlist') ?>" method="post">
                                            <input type="hidden" name="id" value="<?= $value->id ?>">
                                            <td class="pro-remove text-center"><button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                                        </form>
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