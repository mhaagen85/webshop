<?php

namespace Controllers;

use Models\Product;

class ProductController extends AbstractController
{
    /**
     * @var Product
     */
    protected Product $product;

    /**
     * @param Product $product
     */
    public function __construct()
    {
        $this->product = new Product();
    }

    /**
     * @param $path
     * @return mixed|void
     */
    public function view($path)
    {
        $data = [];
        switch ($path) {
            case 'index':
                $data['products'] = $this->product->getAll();
                break;
            case 'add-form':

                isset($_GET['id']) ? $data = $this->product->getById($_GET['id']) : '';
                break;
        }

        $data['template'] = 'product/'. $path;
        $this->renderTemplate($data);
    }

    /**
     * create Product
     */
    public function create()
    {
        $postData = [
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'description' => $_POST['description'],
            'stock' => $_POST['stock']
        ];

        $_POST['id'] ? ($postData['product_id'] = $_POST['id']) && $this->product->update($postData) : $this->product->create($postData);
        $this->redirect('productlist');
    }

    /**
     * Delete Product
     */
    public function delete()
    {
        $this->product->delete($_GET['id']);
        $this->redirect('productlist');
    }
}