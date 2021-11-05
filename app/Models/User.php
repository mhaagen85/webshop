<?php

namespace Models;

class User extends AbstractModel
{
    CONST TABLE = 'Users';
    protected $properties = ['username', 'active', 'password'];

    /**
     * @param $userName
     * @param $password
     * @return bool|\mysqli_result
     */
    public function create($postData)
    {
        $userName = $postData['username'];
        $password = password_hash($postData['password'], PASSWORD_DEFAULT);
        $properties = implode(',', $this->properties);

        return $this->dbConnection->query("INSERT INTO `".self::TABLE."` ($properties) 
                                            VALUES ('".$userName."', 1, '".$password."')");
    }

    /**
     * @param $userName
     * @return bool
     */
    public function getByUserName($userName) : bool
    {
        return $this->dbConnection->query("SELECT * FROM `".self::TABLE."` WHERE username ='".$userName."'")->num_rows == 1;
    }

    /**
     * @param $username
     */
    public function loginUser($username)
    {
        $_SESSION["username"] = $username;
        $_SESSION['loggedin'] = true;
    }

    /**
     * @return bool
     */
    public static function isLoggedIn() : bool
    {
        return isset($_SESSION['loggedin']) ?? false;
    }

    /**
     * logout User
     */
    public static function logout()
    {
        session_destroy();
    }
}