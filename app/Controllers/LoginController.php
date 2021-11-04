<?php

namespace Controllers;

use Core\DbConnection;
use Models\User;

class LoginController extends AbstractController
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

    /*
     * View
     */
    public function view($path)
    {
        $this->user->isLoggedIn() ? $this->redirect('productlist') : $this->renderTemplate('user/' . $path, []);
    }

    /**
     * Login User
     */
    public function login()
    {
        $username = $_POST['username'];
        // Check if user exist in DB, if not redirect to register
        $this->user->getByUserName($username) == false ? $this->redirect('register') : $this->user->LoginUser($username);
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