class TypeSwitcher {
    // Properties
    productType;

    constructor() {
        this.productType = document.querySelector('#productType');

        // Event Listeners
        this.productType.addEventListener('change', this.switchType);
        this.setTypes();
    }

    setTypes() {
        let xhr = new XMLHttpRequest();
        let types;
        xhr.onreadystatechange = () => {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                types = JSON.parse(xhr.responseText);

                let html = `<option value="none" selected disabled>Select type</option>`;
                types.forEach(type => {
                    html += `
                    <option value="${type['type_name']}">${type['type_name'][0].toUpperCase() + type['type_name'].slice(1)}</option>
                    `;
                });
                this.productType.insertAdjacentHTML('afterbegin', html);
            }
        }
        xhr.open('POST', 'http://localhost/productsdemo/products/types', true);
        xhr.send(null);
    }

    getValues() {

    }

    switchType() {
        let container = document.querySelector('#productTypeContainer');
        container.insertAdjacentHTML('afterbegin', '');

        if (this.productType.value != 'none') {
            // values needed
            // 
            let option = `
            <label for="value">Value: <sup>*</sup></label>
            <input type="text" name="value" id="price" class="form-control form-control-lg <?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['price']; ?>">
            <span class="invalid-feedback"><?php echo $data['price_err']; ?></span>
            `
        }


    }
}

// 4, 5, 6 - d b f

new TypeSwitcher();
