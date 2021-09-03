<?php require(APPROOT . '/views/inc/header.php') ?>

<h1><?php echo $data['title'] ?></h1>

<a href="<?php echo URLROOT; ?>/products" class="btn btn-light"><i class="fa fa-backward mr-1"></i>Back</a>
<div class="card card-body bg-light mt-5">
    <h2>Add Post</h2>
    <p>Create a post with this form</p>
    <form action="<?php echo URLROOT; ?>/posts/add" method="post">
        <div class="form-group">
            <label for="sku">SKU: <sup>*</sup></label>
            <input type="text" name="sku" id="sku" class="form-control form-control-lg <?php echo (!empty($data['sku_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['sku']; ?>">
            <span class="invalid-feedback"><?php echo $data['sku_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="name">Name: <sup>*</sup></label>
            <input type="text" name="name" id="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="price">Price: <sup>*</sup></label>
            <input type="number" name="price" id="price" class="form-control form-control-lg <?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['price']; ?>">
            <span class="invalid-feedback"><?php echo $data['price_err']; ?></span>
        </div>

        <label for="productType">Type Switcher</label>
        <select name="productType" id="productType">
        </select><br>
        <input type="submit" class="btn btn-success" value="Save">
        <div id="productTypeContainer"></div>
    </form>
</div>

<script src="<?php echo URLROOT; ?>/js/add.js"></script>
<?php require(APPROOT . '/views/inc/footer.php') ?>