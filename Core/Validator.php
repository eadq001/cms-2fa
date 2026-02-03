<?php declare(strict_types=1);

namespace Core;

class Validator
{
    protected $errors = [];

    public static function string($value, $min = 4, $max = INF)
    {
        $string = trim($value);

        return strlen($string) >= $min && strlen($string) <= $max;
    }

    public static function username($username)
    {
        $pattern = '/^[a-zA-Z\d_]{4,50}$/';

        return preg_match($pattern, $username);
    }

    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function passwordValidate($password, $passwordConfirm)
    {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z\d]{8,64}$/';

        // checks if there is a value in passwordConfirm, if not only checks the password
        if (!empty($passwordConfirm)) {
            if ($password === $passwordConfirm) {
                return preg_match($pattern, $password) && preg_match($pattern, $passwordConfirm);
            } else {
                return false;
            }
        }

        return preg_match($pattern, $password);
    }

    public function validateAll($username = null, $email = null, $password = null, $passwordConfirm = null)
    {
        if (!empty($username)) {
            if (!static::string($username)) {
                $this->errors['username'] = 'name must consists of 4 characters and above. uppercase and lowercase letters, digits, and underscore are only allowed';
            }
        }

        if (!empty($email)) {
            if (!static::email($email)) {
                $this->errors['email'] = 'please enter a valid email address';
            }
        }

        if (!empty($password) && !empty($passwordConfirm)) {
            if (!static::passwordValidate($password, $passwordConfirm)) {
                if ($password !== $passwordConfirm) {
                    $this->errors['password'] = 'password do not match';
                } else {
                    $this->errors['password'] = 'password must have an uppercase, lowercase and a number with 8 characters minimum.';
                }
            }
        }
        // execute if password and password confirm is empty. only checks the password field
        if (!static::passwordValidate($password, $passwordConfirm = null)) {
            $this->errors['password'] = 'password must have an uppercase, lowercase and a number with 8 characters minimum.';
        }
    }

    public function errors()
    {
        return $this->errors;
    }
}

?>