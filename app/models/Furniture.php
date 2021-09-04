<?php

class Furniture extends Product
{
    private $table = 'furniture';
    protected $measurement = 'CM';
    protected $info = 'Please, provide dimensions';
    protected $attributes = ['height', 'width', 'length'];


    public function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        $sql = 'SELECT *, products.id AS productId FROM products
        JOIN types ON types.id = products.type_id
        WHERE types.type_name = :table
        GROUP BY products.id DESC';
        $this->db->query($sql);
        $this->db->bind(':table', $this->table);
        $result = $this->db->resultSet();
        return $result;
    }

    public function setInfo()
    {
        $this->info = 'Dimensions: HxLxW';
    }

    function formatMeasurements($dimensions)
    {
        return $dimensions['height'] . 'x' . $dimensions['width'] . 'x' . $dimensions['length'];
    }

    function addData($data)
    {

        $sql = "START TRANSACTION;
                SET @typeId = (SELECT types.id FROM types WHERE types.type_name = :type_name);
                INSERT INTO products (products.name, products.price, products.sku, products.type_id, products.attribute_name, products.attribute_value) 
                VALUES (:name, :price, :sku, @typeId, :attribute_name, :attribute_value);
                COMMIT";
        $this->db->query($sql);
        $this->db->bind(':type_name', $data['type_name']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':sku', $data['sku']);

        $this->db->bind(':attribute_name', 'dimensions');
        $this->db->bind(':attribute_value', $this->formatMeasurements($data['attributes']));
        echo var_dump($data['type_name']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // public function getAttributes()
    // {
    //     $data = [
    //         'attributes' => $this->attributes,
    //         'measurement' => $this->measurement,
    //         'info' => $this->info
    //     ];
    //     return $data;
    // }
}
