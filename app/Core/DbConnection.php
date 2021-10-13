<?php

namespace Core;

class DbConnection
{
    public $conn;

    function __construct(
        $host = '127.0.0.1',
        $user = 'webshop2',
        $pass = 'Amergaard3',
        $db   = 'webshop2'
    ) {
        $this->conn = new \mysqli($host, $user, $pass, $db);
    }

}