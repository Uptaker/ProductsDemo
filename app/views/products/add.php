<?php require(APPROOT . '/views/inc/header.php') ?>

<div class="row mb-3">
    <h3 class="col"><i class="fas fa-info-circle me-3"></i><?php echo $data['title'] ?></h3>
    <div class="col text-end">
        <button type="submit" form="product_form" value="Save" class="btn btn-primary"><i class="fas fa-check me-2"></i>Save</button>
        <a href="<?php echo URLROOT ?>/products" class="btn btn-white"><i class="fas fa-times me-2"></i>Cancel</a>
    </div>
</div>
<div class="card card-body bg-light mt-5">
    <h4>Create a product listing with this form</h4>
    <form action="<?php echo URLROOT; ?>/products/add" method="post" id="product_form">
        <div class="form-group mt-5 mb-3">
            <label for="sku">SKU: <sup>*</sup></label>
            <input type="text" name="sku" id="sku" class="form-control mb-1 <?php echo (!empty($data['sku_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['sku']; ?>">
            <span class="invalid-feedback"><?php echo $data['sku_err']; ?></span>
        </div>
        <div class="form-group mb-3">
            <label for="name">Name: <sup>*</sup></label>
            <input type="text" name="name" id="name" class="form-control mb-1 <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
        </div>
        <div class="form-group mb-3">
            <label for="price">Price: <sup>*</sup></label>
            <input placeholder="$" type="number" name="price" step="any" id="price" class="form-control mb-1 <?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['price']; ?>">
            <span class="invalid-feedback"><?php echo $data['price_err']; ?></span>
        </div>
        <div id="typeContainer">
            <label for="productType">Type Switcher</label>
            <select name="productType" id="productType" class="form-control">
                <option value="none" disabled>Select Type</option>
            </select>
            <span class="invalid-feedback show"><?php echo $data['type_err']; ?></span><br>
            <div id="typeSelectContainer"></div>
        </div>
        <span class="invalid-feedback show"><?php echo $data['attributes_err']; ?></span><br>
    </form>
</div>

<script src="<?php echo URLROOT; ?>/js/add.js"></script>
<?php require(APPROOT . '/views/inc/footer.php') ?>