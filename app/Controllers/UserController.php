<?php

namespace Controllers;

use Models\User;
use Controllers\LoginController;

class UserController extends AbstractController
{
    /**
     * @var User
     */
    protected User $user;

    /**
     * @var \Controllers\LoginController
     */
    protected LoginController $login;

    public function __construct()
    {
        $this->login = new LoginController();
        $this->user = new User();
    }

    /**
     * @param $path
     * View
     */
    public function view($path)
    {
        $data['template'] = 'user/' . $path;
        $this->renderTemplate($data);
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

        $insert = $this->user->create($postData);
        $data['template'] = 'user/register';
        $data['error-message'] = $insert['message'];

        return $insert['code'] ? $this->login->view($data) : $this->redirect('/');
    }
}