<?php declare(strict_types=1);

namespace Core;

class Session
{
    public static function flash(string $key, array $value)
    {
        $_SESSION['_flash'][$key] = $value;
    }

    public static function get($key)
    {
        return $_SESSION['_flash'][$key] ?? null;
    }

    public static function unflash()
    {
        unset($_SESSION['_flash']);
    }

    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function flush()
    {
        $_SESSION = [];
    }

    public static function destroy()
    {
        static::flush();
        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600,$params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}

?>