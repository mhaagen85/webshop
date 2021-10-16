<?php

namespace Core;

use Core\DotEnv;

class DbConnection
{
    protected $dotEnv;

    function __construct(
        DotEnv $dotEnv
    ) {
        $this->dotEnv = $dotEnv;
    }

    public static function getConn()
    {
        (new DotEnv(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env'))->load();

        return new \mysqli(getenv(
            'DATABASE_HOST'), getenv('DATABASE_USER'), getenv('DATABASE_PASSWORD'), getenv('DATABASE_NAME'));
    }

}