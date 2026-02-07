<?php

namespace Core\Middleware;

class PasswordReset
{
    public function handle() {
        if ((!$_SESSION['user'] ?? false) && ($_SESSION['passwordReset'] ?? false)) {
            redirect('/login');
        }
    }
}
