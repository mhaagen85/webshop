<?php

namespace Models;

use Core\DbConnection;

abstract class AbstractModel
{
    protected $conn;
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
        $this->conn = DbConnection::getConn();
    }

    public function getAll()
    {
        return $this->conn->query("SELECT * FROM $this->table")->fetch_all(MYSQLI_ASSOC);
    }
}