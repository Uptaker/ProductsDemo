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

class Product
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getProducts()
    {
        $sql = '
        SELECT products.id, products.name, products.sku, products.price, products.type_id, attributes.id AS attributeId, attribute_value.id as valueId, products.id AS productId, attributes.name AS attributeName, attribute_value.value, types.type_name FROM products
        INNER JOIN types ON products.type_id = types.id
        INNER JOIN attribute_value ON attribute_value.product_id = products.id
        INNER JOIN attributes ON attribute_value.attribute_id = attributes.id
        GROUP BY products.id DESC;
        ';
        $this->db->query($sql);

        return $this->db->resultSet();
    }
}
