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
            // Validate Email
            if (empty($data['sku'])) {
                $data['email_err'] = 'Please enter SKU';
            } else {
                // Check email
                if ($this->productModel->findProductBySku($data['sku'])) {
                    $data['sku_err'] = 'A product with the associated sku already exists';
                }
            }

            // Validate Name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter your password';
            } elseif (strlen($data['password']) < 8) {
                $data['password_err'] = 'Password must be at least 8 characters';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm your password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // Make sure errors are empty
            if (empty($data['sku_err']) && empty($data['price_err']) && empty($data['name_err']) && empty($data['type_name_err']) && empty($data['attributes_err'])) {
                // Validated


                // Register user
                // if ($this->userModel->register($data)) {
                flash('product_add_success', "Product: " . $data['name'] . " successfully added.");
                //     redirect('products/index');
                // } else {
                //     die("Something went wrong!");
                // }
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
}
