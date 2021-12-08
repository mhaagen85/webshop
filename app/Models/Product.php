<?php

namespace Models;

use Core\Database;

class Product extends AbstractModel
{
    CONST TABLE = 'Products';
    CONST ID = 'product_id';

    public string $name;
    public int $price;
    public string $description;
    public int $stock;

    /**
     * @param $postData
     * @return bool|\mysqli_result
     */
    public function create($postData)
    {
        $this->validateData($postData);
        $properties = $this->getClassProperties();

        $stmt = $this->dbConnection->prepare("INSERT INTO `".self::TABLE."` ($properties) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sisi",$this->name,$this->price,$this->description,$this->stock);
        $stmt->execute();
        $stmt->close();
    }

    /**
     * @param $postData
     * @return bool|\mysqli_result
     */
    public function update($postData)
    {
        $id = $postData['product_id'];
        $this->validateData($postData);

        $stmt = $this->dbConnection->prepare("UPDATE `".self::TABLE."` SET name = ?, price = ?, description = ?, stock = ? WHERE product_id = ?");
        $stmt->bind_param("sisii",$this->name,$this->price,$this->description,$this->stock, $id);
        $stmt->execute();
        $stmt->close();
    }

}