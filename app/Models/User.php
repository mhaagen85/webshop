<?php

namespace Models;

use Core\DbConnection;

class User extends AbstractModel
{
    CONST TABLE = 'Users';

    protected $properties = ['username', 'active', 'password'];

    /**
     * @param $postData
     * @return bool|\mysqli_result
     */
    public function create($postData)
    {
        $userName = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $properties = implode(',', $this->properties);

        return $this->getConnection()->query("INSERT INTO `".self::TABLE."` ($properties) 
                                            VALUES ('".$userName."', 1, '".$password."')");
    }
}