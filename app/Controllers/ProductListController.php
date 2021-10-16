<?php

namespace Controllers;

use Models\ProductList;

class ProductListController extends AbstractController
{

    public function view()
    {
        $productListModel = new ProductList();
        $productList = $productListModel->getProductList();
        parent::renderTemplate('productlist', $productList);
    }
}