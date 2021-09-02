<?php

class Products extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Product');
    }

    public function index()
    {
        $products = $this->postModel->getProducts();

        $data = [
            'title' => 'Product List',
            'products' => $products
        ];

        $this->view('products/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us'
        ];
        $this->view('pages/about', $data);
    }
}
