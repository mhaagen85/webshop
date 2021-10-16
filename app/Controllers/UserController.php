<?php

namespace Controllers;

use Models\User;

class UserController extends AbstractController
{

    public function view($path)
    {
        $this->renderTemplate($path, []);
    }

    public function create()
    {
        $postData = [
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ];

        $user = new User;
        $user->create($postData);

        $this->redirect('/');
    }
}