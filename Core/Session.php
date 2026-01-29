<?php
declare(strict_types=1);
namespace Core;

class Session {

    public static function flash(string $key, array $value) {
            $_SESSION['_flash'][$key] = $value;
    }

    public static function get($key) {
        return $_SESSION['_flash'][$key] ?? null;
    }

    public static function unflash() {
        unset($_SESSION['_flash']);
    }

    
}

?>