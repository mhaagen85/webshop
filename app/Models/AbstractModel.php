<?php

namespace Models;

use Core\DbConnection;

abstract class AbstractModel
{
    /**
     * @return mixed
     */
    abstract function create($postData);

    /**
     * @return \mysqli
     */
    public static function getConnection()
    {
        return DbConnection::getConn();
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        $mysqli = self::getConnection();
        $result = $mysqli->query("SELECT * FROM  `".get_called_class()::TABLE."` ")->fetch_all(MYSQLI_ASSOC);
        $result == true ? $mysqli->close() :  $result = "Error getting all records: " . $mysqli->error;

        return $result;
    }

    /**
     * @param $id
     * @return bool|\mysqli_result
     */
    public function delete($id)
    {
        $mysqli = self::getConnection();
        $result = $mysqli->query("DELETE FROM `".get_called_class()::TABLE."` WHERE `".get_called_class()::ID."` = '".$id."'");
        $result == true ? $mysqli->close() :  $result = "Error deleting record: " . $mysqli->error;

        return $result;
    }

    /**
     * @param $id
     * @return array|null
     */
    public function getById($id)
    {
        $mysqli = self::getConnection();
        $result = $mysqli->query("SELECT * FROM `".get_called_class()::TABLE."` WHERE `".get_called_class()::ID."` = '".$id."'")->fetch_assoc();
        $result == true ? $mysqli->close() :  $result = "Error getting record by ID: " . $mysqli->error;

        return $result;
    }

}