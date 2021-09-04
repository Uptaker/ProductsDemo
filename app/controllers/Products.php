<?php

class Products extends Controller
{
    public function __construct()
    {
        $this->productModel = $this->model('Product');
    }

    public function index()
    {
        $products = $this->productModel->getProducts();

        $data = [
            'title' => 'Product List',
            'products' => $products
        ];

        $this->view('products/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $attributes[] = $_POST['attributes'];
            $data = [
                'title' => 'Add Product',

                'sku' => trim($_POST['sku']),
                'price' => trim($_POST['price']),
                'name' => trim($_POST['name']),
                'type_name' => trim($_POST['productType']),

                // Intelliphense was giving me issues here for whatever reason, had to resort to this terribleness for now
                'attributes' => $attributes[0], // ["weight" => 123] or ["width" => #, "length" => #, "height" => #]

                'sku_err' => '',
                'price_err' => '',
                'name_err' => '',
                'type_err' => '',
                'attributes_err' => ''
            ];


            // Validate SKU
            if (empty($data['sku'])) {
                $data['sku_err'] = 'Please enter SKU';
            } else {
                // Check sku
                if ($this->productModel->findProductBySku($data['sku'])) {
                    $data['sku_err'] = 'A product with the associated sku already exists';
                }
            }

            // Validate Name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please the product enter name';
            } elseif (is_numeric($data['name'])) {
                $data['name_err'] = 'Name cannot be a number';
            }

            // Validate Price
            if (empty($data['price'])) {
                $data['price_err'] = 'Please enter the price';
            } elseif (!is_numeric($data['price'])) {
                $data['price_err'] = 'Price must be a numeric value';
            }

            // Validate selected type & attribute
            if ($data['type_name'] == 'none') {
                $data['type_err'] = 'You must select a type!';
            } else {
                $errors = array();
                foreach ($attributes[0] as $key => $value) {
                    if (empty($value)) {
                        array_push($errors, $key);
                        $data['attributes_err'] = 'Entry ' . implode(' ,', $errors) . ' cannot be empty';
                    } elseif (!is_numeric($value)) {
                        array_push($errors, $key);
                        $data['attributes_err'] = 'Entry ' . implode(' ,', $errors) . ' must be numeric';
                    }
                }
            }

            // Make sure errors are empty
            if (empty($data['sku_err']) && empty($data['price_err']) && empty($data['name_err']) && empty($data['type_name_err']) && empty($data['attributes_err'])) {

                // Validated

                $class = ucwords($data['type_name']);
                $this->typeModel = $this->model($class);
                // Add Product
                if ($this->typeModel->addData($data)) {
                    flash('product_add_success', "Product: " . $data['name'] . " successfully added");
                    redirect('products/index');
                } else {
                    die("Something went wrong!");
                }
            } else {
                // Load view with errors
                $this->view('products/add', $data);
            }
        } else {

            // Load the form & init data
            $data = [
                'title' => 'Add Product',

                'sku' => '',
                'price' => '',
                'name' => '',
                'type_name' => '',
                'attributes' => [],

                'sku_err' => '',
                'price_err' => '',
                'name_err' => '',
                'type_err' => '',
                'attributes_err' => ''
            ];

            $this->view('products/add', $data);
        }
    }

    public function types()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $types = $this->productModel->getAllTypes();
            echo json_encode($types);
        } else {
            redirect('products/index');
        }
    }

    public function values($type)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->typeModel = $this->model(ucwords($type));
            $values = $this->typeModel->getAttributes();
            echo json_encode($values);
        } else {
            redirect('products/index');
        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            // Validation
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if (sizeof($_POST['checkbox']) > 0) {
                $ids = [];
                foreach ($_POST['checkbox'] as $id) {
                    array_push($ids, trim($id));
                }

                // Delete Product(s)
                if ($this->productModel->deleteById($ids)) {
                    flash('product_delete_success', "Selected products deleted successfully");
                    redirect('products/index');
                } else {
                    die("Something went wrong!");
                }
            } else {
                flash('product_delete_fail', "You must select at least one item to delete anything", "alert alert-danger");
                redirect('products/index');
            }
        } else {
            redirect('products/index');
        }
    }
}
