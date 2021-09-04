<?php

// This is an example

// START TRANSACTION;
// INSERT INTO products (products.name, products.price, products.sku, products.type_id) VALUES ('History of Heavy Metal', 45, 'EXAMP13', (SELECT types.id FROM types WHERE types.name = 'book'));
// SET @productId = (SELECT LAST_INSERT_ID());
// INSERT INTO attribute_value (attribute_value.value, attribute_value.product_id) VALUES ('2 KG', @productId);
// SET @valueId = (SELECT LAST_INSERT_ID());
// INSERT INTO attributes (attributes.name) VALUES ('weight');
// SET @attributeId = (SELECT LAST_INSERT_ID());
// UPDATE attribute_value SET attribute_value.attribute_id = @attributeId;
// COMMIT;

//new
// START TRANSACTION;
// SET @typeId = (SELECT types.id FROM types WHERE types.type_name = 'book');
// INSERT INTO products (products.name, products.price, products.sku, products.type_id) VALUES ('Example Book', 45, 'EXAMP1BKJ23', @typeId);
// SET @productId = (SELECT LAST_INSERT_ID());
// INSERT INTO attribute_value (attribute_value.value, attribute_value.product_id, attribute_type_id) VALUES ('1 KG', @productId, @typeId);
// SET @valueId = (SELECT LAST_INSERT_ID());
// INSERT INTO attributes (attributes.name) VALUES ('weight');
// SET @attributeId = (SELECT LAST_INSERT_ID());
// UPDATE attribute_value SET attribute_value.attribute_id = @attributeId;
// COMMIT;

// for furniture

// START TRANSACTION;
// SET @typeId = (SELECT types.id FROM types WHERE types.type_name = 'book');
// INSERT INTO products (products.name, products.price, products.sku, products.type_id) VALUES ('Exotic Lamp Post', 45, 'L0V3LAMP', @typeId);
// SET @productId = (SELECT LAST_INSERT_ID());

// INSERT INTO attribute_value (attribute_value.value, attribute_value.product_id, attribute_type_id) VALUES ('50', @productId, @typeId);
// SET @valueId = (SELECT LAST_INSERT_ID());
// INSERT INTO attributes (attributes.name) VALUES ('height');
// SET @attributeId = (SELECT LAST_INSERT_ID());
// UPDATE attribute_value SET attribute_value.attribute_id = @attributeId WHERE attribute_value.id = @valueId;

// INSERT INTO attribute_value (attribute_value.value, attribute_value.product_id, attribute_type_id) VALUES ('20', @productId, @typeId);
// SET @valueId = (SELECT LAST_INSERT_ID());
// INSERT INTO attributes (attributes.name) VALUES ('width');
// SET @attributeId = (SELECT LAST_INSERT_ID());
// UPDATE attribute_value SET attribute_value.attribute_id = @attributeId WHERE attribute_value.id = @valueId;

// INSERT INTO attribute_value (attribute_value.value, attribute_value.product_id, attribute_type_id) VALUES ('25', @productId, @typeId);
// SET @valueId = (SELECT LAST_INSERT_ID());
// INSERT INTO attributes (attributes.name) VALUES ('length');
// SET @attributeId = (SELECT LAST_INSERT_ID());
// UPDATE attribute_value SET attribute_value.attribute_id = @attributeId WHERE attribute_value.id = @valueId;

// COMMIT;

// START TRANSACTION;
// SET @typeId = (SELECT types.id FROM types WHERE types.type_name = 'furniture');
// INSERT INTO products (products.name, products.price, products.sku, products.type_id) VALUES ('Exotic Lamp Post', 45, 'L0V3LAMP', @typeId);
// SET @productId = (SELECT LAST_INSERT_ID());

// INSERT INTO attribute_value (attribute_value.value, attribute_value.product_id, attribute_type_id) VALUES ('50', @productId, @typeId);
// SET @valueId = (SELECT LAST_INSERT_ID());
// SET @attributeId = (SELECT attributes.id FROM attributes WHERE attributes.name = 'height');
// UPDATE attribute_value SET attribute_value.attribute_id = @attributeId WHERE attribute_value.id = @valueId;

// INSERT INTO attribute_value (attribute_value.value, attribute_value.product_id, attribute_type_id) VALUES ('20', @productId, @typeId);
// SET @valueId = (SELECT LAST_INSERT_ID());
// SET @attributeId = (SELECT attributes.id FROM attributes WHERE attributes.name = 'width');
// UPDATE attribute_value SET attribute_value.attribute_id = @attributeId WHERE attribute_value.id = @valueId;

// INSERT INTO attribute_value (attribute_value.value, attribute_value.product_id, attribute_type_id) VALUES ('25', @productId, @typeId);
// SET @valueId = (SELECT LAST_INSERT_ID());
// SET @attributeId = (SELECT attributes.id FROM attributes WHERE attributes.name = 'length');
// UPDATE attribute_value SET attribute_value.attribute_id = @attributeId WHERE attribute_value.id = @valueId;

// COMMIT;

// SELECT products.id, products.name, products.sku, products.price, products.type_id, attributes.id AS attributeId,
//         attribute_value.id as valueId, products.id AS productId, attributes.name AS attributeName, attribute_value.value,
//         types.type_name, types.type_measurement, attributes.attribute_measurement
//         FROM products
//         INNER JOIN types ON products.type_id = types.id
//         INNER JOIN attribute_value ON attribute_value.product_id = products.id
//         INNER JOIN attributes ON attribute_value.attribute_id = attributes.id
//         GROUP BY products.id DESC;

// START TRANSACTION;
// SET @typeId = (SELECT types.id FROM types WHERE types.type_name = 'dvd');
// INSERT INTO products (products.name, products.price, products.sku, products.type_id, products.attribute_name, products.attribute_value) VALUES ('WALL-E', 15, 'WLLE1SGU7', @typeId, 'size', '3500');
// COMMIT;

class Product
{
    protected $db;
    protected $name;
    protected $price;
    protected $sku;
    protected $attributes = [];


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

        // echo var_dump($result);

        return $result;
    }

    function findProductBySku($sku)
    {
        $sql = 'SELECT * FROM products WHERE sku = :sku';
        $this->db->query($sql);
        $this->db->bind(':sku', $sku);

        return $this->db->single();
    }

    function addData()
    {
    }
}
