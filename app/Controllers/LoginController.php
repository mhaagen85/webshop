<?php

namespace Controllers;

use Core\DbConnection;

class LoginController extends AbstractController
{
    protected $conn;

    public function __construct()
    {
        $this->conn = DbConnection::getConn();
    }


    public function view($path)
    {
        if (isset($_SESSION['username'])) {
            $this->redirect('productlist');
        }

        $this->renderTemplate('user/' . $path, []);
    }

    public function login()
    {
        $username = $_POST['username'];
        if ($this->conn->query("SELECT * FROM Users WHERE username ='".$username."'")->num_rows == 0) {
            $this->redirect('register');
        }

        $_SESSION["username"] = $_POST['username'];
        $_SESSION['loggedin'] = true;

        $this->redirect('productlist');
    }

    public function getLoggedInUser()
    {
        $username = $_SESSION['username'];
        $loggedIn = $_SESSION['loggedin'];

        if ($username && $loggedIn){
            return 'true';
        }

        return false;
    }

    public function logout()
    {
        session_destroy();

        $this->redirect('login');
    }
}