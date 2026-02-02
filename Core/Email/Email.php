<?php
declare(strict_types=1);
namespace Core\Email;
use Core\Database;

class Email {
    protected static $db;

    public function __construct() {
        self::$db = new Database();
    }

    public static function isEmailExist($email) {

        if(!self::$db) {
            self::$db = new Database();
        }
        
        $user = self::$db->query('SELECT * FROM users where email = :email LIMIT 1', ['email' => $email])->get();

        return $user;
    }
}
?>