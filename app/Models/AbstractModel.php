<?php

namespace Models;

use Core\DbConnection;

abstract class AbstractModel
{
    /**
     * @var \mysqli
     */
    protected $conn;

    /**
     * @var
     */
    protected $table;

    /**
     * @param $table
     */
    public function __construct($table)
    {
        $this->table = $table;
        $this->conn = DbConnection::getConn();
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->conn->query("SELECT * FROM $this->table")->fetch_all(MYSQLI_ASSOC);
    }

}