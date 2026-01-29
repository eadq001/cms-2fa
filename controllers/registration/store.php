<?php declare(strict_types=1);

use Core\Session;
use Core\Validator;
use Mailer\Mailer;

$mail = new Mailer();

$email = $_POST['email'];
$name = $_POST['name'];
$password = $_POST['password'];
$passwordConfirm = $_POST['password_confirmation'];

$errors = [];

if (!Validator::string($name, 4)) {
    $errors['name'] = ['please enter a minimum characters of 4'];
}

if (!Validator::email($email)) {
    $errors['email'] = 'please enter a valid email address';
}

if (!Validator::passwordValidate($password, $passwordConfirm)) {
    $errors['password'] = 'password must have an uppercase, lowercase and a number with 8 characters minimum.';
}

if ($password !== $passwordConfirm) {
    $errors['password'] = 'password do not match';
}

if (!empty($errors)) {
    Session::flash('old', [
        'email' => $_POST['email'],
        'name' => $_POST['name'],
        'password' => $_POST['password'],
        'passwordConfirm' => $_POST['password_confirmation']
    ]);

    Session::flash('errors',
        $errors);
    // dd($_SESSION);

    redirect('/register');
}

$mail->sendOtp($email, $name);

?>