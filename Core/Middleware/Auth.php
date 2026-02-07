<?php
declare(strict_types=1);

namespace Core\Middleware;

class Auth {
    public function handle() {
        if (! $_SESSION['user'] && !$_SESSION['logged_in'] ?? false) {
            redirect('/login');
        }
    }
}

?>