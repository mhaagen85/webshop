<?php

namespace Models;

class User extends AbstractModel
{
    CONST TABLE = 'Users';

    public string $username;
    public int $active = 1;
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

        $stmt = $this->dbConnection->prepare("INSERT INTO `".self::TABLE."` ($properties) VALUES (?, ?, ?)");
        $stmt->bind_param("sis",$this->username,$this->active,$this->password);
        $stmt->execute();
        $stmt->close();
    }

    /**
     * @param $userName
     * @return bool
     */
    public function getByUserName($username) : bool
    {
        $stmt = $this->dbConnection->prepare("SELECT * FROM `".self::TABLE."` WHERE username = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute();

        return $stmt->num_rows();
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