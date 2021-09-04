<?php require(APPROOT . '/views/inc/header.php') ?>

<div class="container">
    <div class="row mb-3">
        <h3 class="col"><?php echo $data['title'] ?></h3>
        <div class="col text-end">
            <a href="<?php echo URLROOT ?>/products/add" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add</a>
            <a href="<?php echo URLROOT ?>/products/remove" class="btn btn-danger"><i class="fas fa-trash me-2"></i>Mass Delete</a>
        </div>
    </div>
    <div class="grid-wrapper">
        <?php foreach ($data['products'] as $product) : ?>
            <div class="card">
                <div class="card-body">
                    <div class="divider">
                        <div>
                            <input class="checkbox-large" type="checkbox" value="">
                        </div>
                        <div class="text-right">
                            <p class="card-text"><?php echo ucwords($product->type_name); ?></p>
                            <h5 class="card-title"><?php echo $product->name; ?></h5>
                        </div>
                    </div>

                    <hr>
                    <div class="text-center">
                        <p class="card-text"><?php echo round($product->price, 2) ?> $</p>
                        <p class="card-text"><?php echo ucwords($product->attribute_name) . ": " . $product->attribute_value; ?></p>
                        <p class="card-text"><?php echo $product->sku; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require(APPROOT . '/views/inc/footer.php') ?>