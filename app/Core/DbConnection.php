<?php

namespace Core;

use Core\DotEnv;

class DbConnection
{
    /**
     * @var \Core\DotEnv
     */
    protected $dotEnv;

    /**
     * @param \Core\DotEnv $dotEnv
     */
    function __construct(
        DotEnv $dotEnv
    ) {
        $this->dotEnv = $dotEnv;
    }

    /**
     * @return \mysqli
     */
    public static function getConn()
    {
        (new DotEnv(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env'))->load();

        $mysqli =  new \mysqli(getenv(
            'DATABASE_HOST'), getenv('DATABASE_USER'), getenv('DATABASE_PASSWORD'), getenv('DATABASE_NAME'));

        if ($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }

        return $mysqli;
    }

}