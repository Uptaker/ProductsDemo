<?php

class Product
{
    protected $db;
    protected $name;
    protected $price;
    protected $sku;
    protected $attributes = [];
    protected $info;
    protected $measurement;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllTypes()
    {
        $sql = 'SELECT * FROM types';
        $this->db->query($sql);

        return $this->db->resultSet();
    }

    public function getProducts()
    {
        $categories = $this->getAllTypes();

        $result = [];

        // Get customized data for each type
        foreach ($categories as $category) {
            $category = ucwords($category->type_name);
            $product = new $category();
            $arr = $product->getData();
            $result = array_merge($result, $arr);
        }

        // Sort by id, descending
        usort($result, function ($a, $b) {
            return $b->productId <=> $a->productId;
        });

        return $result;
    }

    function findProductBySku($sku)
    {
        $sql = 'SELECT * FROM products WHERE sku = :sku';
        $this->db->query($sql);
        $this->db->bind(':sku', $sku, PDO::PARAM_STR);

        return $this->db->single();
    }

    public function getAttributes()
    {
        $data = [
            'attributes' => $this->attributes,
            'measurement' => $this->measurement,
            'info' => $this->info
        ];
        return $data;
    }

    function addData($data)
    {

        $sql = "START TRANSACTION;
                SET @typeId = (SELECT types.id FROM types WHERE types.type_name = :type_name);
                INSERT INTO products (products.name, products.price, products.sku, products.type_id, products.attribute_name, products.attribute_value) 
                VALUES (:name, :price, :sku, @typeId, :attribute_name, :attribute_value);
                COMMIT";
        $this->db->query($sql);
        $this->db->bind(':type_name', $data['type_name'], PDO::PARAM_STR);
        $this->db->bind(':name', $data['name'], PDO::PARAM_STR);
        $this->db->bind(':price', $data['price'], PDO::PARAM_STR);
        $this->db->bind(':sku', $data['sku'], PDO::PARAM_STR);

        // Get attribute key, value and assign them
        $name = '';
        $value = '';
        foreach ($data['attributes'] as $key => $v) {
            $name = $key;
            $value = $v;
        }

        $this->db->bind(':attribute_name', $name, PDO::PARAM_STR);
        $this->db->bind(':attribute_value', $value, PDO::PARAM_STR);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteById($ids)
    {
        // Apparently PDO doesn't support prepared statements with arrays? :(
        $questionMarks = str_repeat('?,', count($ids) - 1) . '?';

        // Turn into real ints
        $ids = array_map(function ($num) {
            return intval($num);
        }, $ids);

        // Turn to single string
        $ids = implode(',', $ids);

        $sql = "DELETE FROM products WHERE FIND_IN_SET(id, :id)";
        $this->db->query($sql);
        $this->db->bind(':id', $ids);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
