<?php

namespace Models;

class User extends AbstractModel
{
    CONST TABLE = 'Users';

    public string $username;
    public int $active;
    public string $password;

    /**
     * @param $userName
     * @param $password
     * @return bool|\mysqli_result
     */
    public function create($postData)
    {
        $this->validateData($postData);
        $this->hashPassword($this->password);
        $properties = $this->getClassProperties();

        return $this->dbConnection->query("INSERT INTO `".self::TABLE."` ($properties) 
                                            VALUES ('".$this->username."', 1, '".$this->password."')");
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

    /**
     * @param $password
     */
    protected function hashPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
}