<?php

namespace Controllers;

use Core\Database;
use Models\User;

class LoginController extends AbstractController
{
    /**
     * @var User
     */
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /*
     * View
     */
    public function view($path)
    {
        is_array($path) ? $data = $path : $data['template'] = 'user/' . $path;
        $this->user->isLoggedIn() ? $this->redirect('productlist') : $this->renderTemplate($data);
    }

    /**
     * Login User
     */
    public function login()
    {
        // Validate User
        try {
            $this->user->validateUser();
        } catch (\Exception $e) {
            $data['template'] = 'user/login';
            $data['error-message'] = $e->getMessage();

            return $this->view($data);
        }

        $this->user->LoginUser($_POST['username']);
        $this->redirect('productlist');
    }

    /**
     * logout User
     */
    public function logout()
    {
        $this->user->logout();
        $this->redirect('login');
    }
}