<?php

namespace Core\Middleware;

class Verification
{
    public function handle()
    {
        if (!$_SESSION['verification'] ?? false && !$_SESSION['user'] ?? false) {
            redirect('/login');
        }
    }
}
