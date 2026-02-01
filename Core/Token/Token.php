<?php

namespace Core\Token;

use Core\Database;

class Token
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function checkTokenExpiry($token)
    {
        $user = $this->db->query('SELECT * FROM email_verifications WHERE token = :token LIMIT 1', ['token' => $token])->get();
        if ($user) {
            if (date('Y-m-d H:i:s') >= $user['time_expires']) {
                $user = $this->db->query('DELETE FROM email_verifications WHERE id = :id', ['id' => $user['id']]);
            }
        }

        return $user;
    }
}
