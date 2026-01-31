<?php declare(strict_types=1);

namespace Core;

class Validator
{
    public static function string($value, $min = 4, $max = INF)
    {
        $string = trim($value);

        return strlen($string) >= $min && strlen($string) <= $max;
    }

    public static function username($username) {
        $pattern = "/^[a-zA-Z\d_]{4,50}$/";

        return preg_match($pattern, $username);
    }

    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function passwordValidate($password, $passwordConfirm)
    {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z\d]{8,64}$/';

        if ($password === $passwordConfirm) {
            return preg_match($pattern, $password) && preg_match($pattern, $passwordConfirm);
        }

        else {
            return false;
        }

   
    }

}

?>