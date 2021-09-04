<?php require(APPROOT . '/views/inc/header.php') ?>

<div class="container">
    <div class="row mb-3">
        <h3 class="col"><i class="fas fa-info-circle me-3"></i><?php echo $data['title'] ?></h3>
        <div class="col text-end">
            <a href="<?php echo URLROOT ?>/products/add" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add</a>
            <button id="delete-product-btn" type="submit" form="del" value="Mass Delete" class="btn btn-danger"><i class="fas fa-trash me-2"></i>Mass Delete</button>
            <form action="<?php echo URLROOT; ?>/products/delete" method="post" id="del">
        </div>
    </div>
    <?php flash('product_add_success') ?>
    <?php flash('product_delete_success') ?>
    <?php flash('product_delete_fail') ?>
    <div class="grid-wrapper">
        <?php foreach ($data['products'] as $product) : ?>
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="divider mb-2">
                            <input class="delete-checkbox" type="checkbox" name="checkbox[]" value="<?php echo $product->productId ?>">
                            <p class="card-text"><?php echo ucwords($product->type_name); ?></p>
                        </div>
                        <div class="text-center">
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