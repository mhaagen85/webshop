<?php

namespace Models;

use Core\DbConnection;

class User
{
    protected $conn;

    public function __construct()
    {
        $this->conn = DbConnection::getConn();
    }

    public function create($postData)
    {
        $userName = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        return $this->conn->query("INSERT INTO Users 
                                    (username, active, password) 
                                        VALUES ('".$userName."', 1, '".$password."')");
    }
}