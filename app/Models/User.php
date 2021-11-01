<?php

namespace Models;

use Core\DbConnection;

class User extends AbstractModel
{
    const TABLE = 'Users';

    /**
     * Parent table
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param $postData
     * @return bool|\mysqli_result
     */
    public function create($postData)
    {
        $userName = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        return $this->conn->query("INSERT INTO Users (username, active, password) 
                                            VALUES ('".$userName."', 1, '".$password."')");
    }
}