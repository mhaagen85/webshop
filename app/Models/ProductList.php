<?php

namespace Models;

use Core\DbConnection;

class ProductList extends AbstractModel
{
    const TABLE = 'Products';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

}