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
        $data = [
            'title' => 'Add Product'
        ];
        $this->view('products/add', $data);
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
}
