<?php

namespace Controllers;

use Models\Product;

class ProductController extends AbstractController
{

    public function view($type)
    {
        $data = [];
        switch ($type) {
            case 'index':
                $productModel = new Product();
                $data = $productModel->getAll();
                break;
            case 'add-form':
                $productModel = new Product();
                $data = $productModel->getById($_GET['id']);
                break;
        }

        $this->renderTemplate('product/'.$type , $data);
    }

    public function create()
    {
        $product = new Product();
        $postData = [
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'description' => $_POST['description'],
            'stock' => $_POST['stock']
        ];

        if ($_POST['id']) {
            $postData['product_id'] = $_POST['id'];
            $product->update($postData);
        } else {
            $product->create($postData);
        }

        $this->redirect('productlist');
    }

    public function delete()
    {
        $productModel = new Product();
        $productModel->delete();

        $this->redirect('productlist');
    }
}