<?php

namespace Models;

use Controllers\UserController;
use Traits\TestTrait;

class User extends AbstractModel
{
    CONST TABLE = 'Users';
    use TestTrait;

    public string $username;
    public int $active = 1;
    public string $password;

    /**
     * @param $userName
     * @param $password
     */
    public function create($postData)
    {
        $this->validateData($postData);
        $this->hashPassword($this->password);
        $properties = $this->getClassProperties();

        $stmt = $this->dbConnection->prepare("INSERT INTO `".self::TABLE."` ($properties) VALUES (?, ?, ?)");
        $stmt->bind_param("sis",$this->username,$this->active,$this->password);
        $stmt->execute();

        $insert['code'] =  $stmt->errno;
        $insert['message'] = $stmt->errno ? $stmt->error : 'success';
        $stmt->close();

        return $insert;
    }

    /**
     * @param $username
     * @return bool
     * @throws \ErrorException
     */
    public function validateUsername($username)
    {
        $stmt = $this->dbConnection->prepare("SELECT * FROM `".self::TABLE."` WHERE username = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute();

        if ($stmt->get_result()->num_rows == false) {
            throw new \ErrorException('Username not Found');
        }

        return true;
    }

    /**
     * @return bool
     * @throws \ErrorException
     */
    public function validateUser()
    {
        $stmt = $this->dbConnection->prepare("SELECT * FROM `".self::TABLE."` WHERE username = ?");
        $stmt->bind_param("s",$_POST['username']);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if (!$user) {
            throw new \ErrorException('Username not Found');
        }

        if (password_verify($_POST['password'], $user['password']) == false) {
            throw new \ErrorException('Invalid password.');
        }

        return true;
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