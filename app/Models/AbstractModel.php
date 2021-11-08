<?php

namespace Models;

use Core\DbConnection;

abstract class AbstractModel
{
    /**
     * @var \mysqli
     */
    protected $dbConnection;

    /**
     * Db Connection
     */
    public function __construct()
    {
        $this->dbConnection = DbConnection::getConn();
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
        $result =  $this->dbConnection->query("SELECT * FROM  `".get_called_class()::TABLE."` ")->fetch_all(MYSQLI_ASSOC);
        $result == true ?  $this->dbConnection->close() :  $result = "Error getting all records: " . $this->dbConnection->error;

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
        $result = $this->dbConnection->query("SELECT * FROM `".get_called_class()::TABLE."` WHERE `".get_called_class()::ID."` = '".$id."'")->fetch_assoc();
        $result == true ?  $this->dbConnection->close() :  $result = "Error getting record by ID: " . $this->dbConnection->error;

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
            if ($key != "dbConnection")
                $properties = $properties . ',' . $key;
        }

        return substr($properties, 1);
    }

}