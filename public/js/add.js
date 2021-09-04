document.addEventListener('DOMContentLoaded', () => {
    new TypeSwitcher();
})

class TypeSwitcher {
    // Properties
    productType;

    constructor() {
        this.productType = document.querySelector('#productType');
        // Event Listeners
        this.setTypes();
        this.productType.addEventListener('change', this.switchType);
    }

    // Generates the unique product attribute form for each type/category
    switchType() {
        let currentType = document.querySelector('#productType').value;
        let obj;
        fetch(`http://localhost/productsdemo/products/values/${currentType}`, {
            method: 'POST'
        })
        .then((response) => {
            return response.text();
        })
        .then((json) => {
            obj = JSON.parse(json);
        })
        .then(() => {

            let container = document.querySelector('#typeSelectContainer');
            container.innerHTML = "";

            let html = `<h5 class="text-center">${obj.info}</h5><br><h6 class="text-center">${currentType[0].toUpperCase() + currentType.slice(1)}</h6>`;
            obj.attributes.forEach(value => {
                html += `
                    <div class="form-group">
                    <label for="${value}">${value[0].toUpperCase() + value.slice(1)} (in ${obj.measurement}): <sup>*</sup></label>
                    <input type="text" name="${value}" id="${value}" class="form-control mb-3" value="">
                    <span id="err_${value}"; ?></span>
                    </div>
                `;
            });

            container.insertAdjacentHTML('afterbegin', html);
        });
    }

    // Fetches every available type in the DB and sets them as selectable options
    setTypes() {
        let types;
        fetch('http://localhost/productsdemo/products/types', {
            method: 'POST'
        })
        .then((response) => {
            return response.text();
        })
        .then((json) => {
            types = JSON.parse(json);
        })
        .then(() => {

            const list = document.querySelector('#productType');

            // Create default selected disabled option
            let option = document.createElement("option");
            option.value = 'none';
            option.text = 'Select Type';
            option.selected = true;
            option.disabled = true;
            list.appendChild(option);

            // Loop to create the options
            for (let i = 0; i < types.length; i++) {
                let option = document.createElement("option");
                option.value = types[i]['type_name'];
                option.text = types[i]['type_name'][0].toUpperCase() + types[i]['type_name'].slice(1);
                list.appendChild(option);
            }
            console.log(this.productType.value)
        });
    }
}
