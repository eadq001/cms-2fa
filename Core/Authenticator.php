<?php declare(strict_types=1);

Namespace Core;

use Core\Database;

class Authenticator
{
    protected static $db;

    public function attemptLogin($email, $password)
    {
        self::$db = new Database();
        $user = self::$db->query('SELECT id, username, password FROM users WHERE email = :email', ['email' => $email])->get();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->login(['email' => $email]);   
            }
        }
        return $user;
    }

    public function login($user)
    {   $_SESSION['logged_in'] = true;
        $_SESSION['user'] = ['email' => $user['email']];
        session_regenerate_id(true);
    }

    public function logout() {
        \Core\Session::destroy();
    }
}

?>