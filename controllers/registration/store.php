<?php
declare(strict_types=1);

use Core\Validator;

$email = $_POST['email'];
$name = $_POST['name'];
$password = $_POST['password'];
$passwordConfirm = $_POST['password_confirmation'];

$errors = [];

if(! Validator::string($name, 4)) {
    $errors['name'] = ['please enter a minimum characters of 4'];
}

if (! Validator::email($email)) {
    $errors['email'] = 'please enter a valid email address';
}

if (! Validator::passwordValidate($password, $passwordConfirm)) {
    $errors['password'] = 'password must have an uppercase, lowercase and a number with 8 characters minimum.';
}

// dd($_SERVER['REQUEST_METHOD']);

if (! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

?>