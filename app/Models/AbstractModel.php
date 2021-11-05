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
        $result == true ?  $this->dbConnection->close() :  $result = "Error getting all records: " .  $this->dbConnection->error;

        return $result;
    }

    /**
     * @param $id
     * @return bool|\mysqli_result
     */
    public function delete($id)
    {
        $result =  $this->dbConnection->query("DELETE FROM `".get_called_class()::TABLE."` WHERE `".get_called_class()::ID."` = '".$id."'");
        $result == true ?  $this->dbConnection->close() :  $result = "Error deleting record: " .  $this->dbConnection->error;

        return $result;
    }

    /**
     * @param $id
     * @return array|null
     */
    public function getById($id)
    {
        $result = $this->dbConnection->query("SELECT * FROM `".get_called_class()::TABLE."` WHERE `".get_called_class()::ID."` = '".$id."'")->fetch_assoc();
        $result == true ?  $this->dbConnection->close() :  $result = "Error getting record by ID: " .  $this->dbConnection->error;

        return $result;
    }

}