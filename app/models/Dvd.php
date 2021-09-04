<?php

class Dvd extends Product
{
    private $table = 'dvd';
    private $measurement = 'MB';
    private $info = 'Please, provide size';
    protected $attributes = ['size'];


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
        $result = $this->getInfo($result);
        return $result;
    }

    public function getInfo($data)
    {
        for ($i = 0; $i < sizeof($data); $i++) {
            $data[$i]->attribute_value = $data[$i]->attribute_value . ' MB';
        }
        return $data;
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
