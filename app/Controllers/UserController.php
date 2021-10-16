<?php

namespace Controllers;

use Models\User;

class UserController extends AbstractController
{

    public static function view($path)
    {
        parent::renderTemplate($path, []);
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