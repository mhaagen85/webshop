<?php

namespace Models;

use Core\DbConnection;

abstract class AbstractModel
{
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
    public static function getAll()
    {
        return self::getConnection()->query("SELECT * FROM  `".get_called_class()::TABLE."` ")->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * @param $id
     * @return bool|\mysqli_result
     */
    public static function delete($id)
    {
        return self::getConnection()->query("DELETE FROM `".get_called_class()::TABLE."` WHERE `".get_called_class()::ID."` = '".$id."'");
    }

    /**
     * @param $id
     * @return array|null
     */
    public static function getById($id)
    {
        return self::getConnection()->query("SELECT * FROM `".get_called_class()::TABLE."` WHERE `".get_called_class()::ID."` = '".$id."'")->fetch_assoc();
    }

}