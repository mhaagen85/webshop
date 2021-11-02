<?php

namespace Controllers;

use Models\User;

class UserController extends AbstractController
{
    /**
     * @param $path
     * View
     */
    public function view($path)
    {
        $this->renderTemplate('user/' . $path, []);
    }

    /**
     * create User
     */
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