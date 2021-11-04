<?php

namespace Controllers;

use Models\User;

class UserController extends AbstractController
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

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
            'password' => $_POST['password'],
        ];

        $this->user->create($postData);
        $this->redirect('/');
    }
}