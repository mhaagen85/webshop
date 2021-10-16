<?php

namespace Controllers;

use Models\ProductList;

class ProductListController extends AbstractController
{

    public function view()
    {
        $productListModel = new ProductList();
        $productList = $productListModel->getAll();
        $this->renderTemplate('productlist', $productList);
    }
}