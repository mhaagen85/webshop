<?php

namespace Controllers;

use Core\DbConnection;
use Models\User;

class LoginController extends AbstractController
{
    /**
     * @var \mysqli 
     */
    protected $conn;

    /**
     * db Connection
     */
    public function __construct()
    {
        $this->conn = DbConnection::getConn();
    }

    /*
     * View
     */
    public function view($path)
    {
        if (isset($_SESSION['username'])) {
            $this->redirect('productlist');
        }

        $this->renderTemplate('user/' . $path, []);
    }

    /**
     * Login User
     */
    public function login()
    {
        $username = $_POST['username'];
        if ($this->conn->query(User::getByUserName($username)) == false) {
            $this->redirect('register');
        }

        $_SESSION["username"] = $username;
        $_SESSION['loggedin'] = true;

        $this->redirect('productlist');
    }

    /**
     * @return false|string
     */
    public function getLoggedInUser()
    {
        $username = $_SESSION['username'];
        $loggedIn = $_SESSION['loggedin'];

        if ($username && $loggedIn){
            return 'true';
        }

        return false;
    }

    /**
     * logout User
     */
    public function logout()
    {
        session_destroy();

        $this->redirect('login');
    }
}