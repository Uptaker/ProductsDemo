<?php

class Furniture extends Product
{
    private $table = 'furniture';
    private $measurement = 'CM';
    private $info = 'Please, provide dimensions';
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

    public function addData()
    {
    }

    public function deleteData()
    {
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
}
