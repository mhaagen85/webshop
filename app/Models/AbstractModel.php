<?php

namespace Models;

use Core\Database;

abstract class AbstractModel
{
    /**
     * @var \mysqli
     */
    protected \mysqli $dbConnection;

    /**
     * Db Connection
     */
    public function __construct()
    {
        $this->dbConnection = Database::getConnection();
    }
    /**
     * @return mixed
     */
    abstract function create($postData);

    /**
     * @return mixed
     */
    public function getAll()
    {
        $stmt = $this->dbConnection->prepare("SELECT * FROM  `".get_called_class()::TABLE."` ");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $result == true ?  $stmt->close() :  $result = "Error getting all records: " . $stmt->error;

        return $result;
    }

    /**
     * @param $id
     * @return bool|\mysqli_result
     */
    public function delete($id)
    {
        $stmt = $this->dbConnection->prepare("DELETE FROM `".get_called_class()::TABLE."` WHERE `".get_called_class()::ID."` = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->affected_rows > 0 ? $stmt->close() : $stmt->error;
    }

    /**
     * @param $id
     * @return array|null
     */
    public function getById($id)
    {
        $stmt = $this->dbConnection->prepare("SELECT * FROM `".get_called_class()::TABLE."` WHERE `".get_called_class()::ID."` = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $result == true ?  $stmt->close() :  $result = "Error getting record by ID: " . $stmt->error;

        return $result;
    }

    /**
     * @param $postData
     */
    protected function validateData($postData)
    {
        foreach($postData as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @return false|string
     */
    protected function getClassProperties()
    {
        $properties = '';
        foreach(get_class_vars(get_called_class()) as $key => $value){
                $properties = $properties . ',' . $key;
        }

        return substr($properties, 1);
    }

}