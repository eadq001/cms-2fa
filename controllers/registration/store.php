<?php declare(strict_types=1);

use Core\Database;
use Core\Session;
use Core\Validator;
use Mailer\Mailer;

$db = new Database;
$mail = new Mailer();

$email = $_POST['email'];
$name = $_POST['name'];
$password = $_POST['password'];
$passwordConfirm = $_POST['password_confirmation'];
$token = md5((string) rand());
$code = sprintf("%06d", random_int(000000, 999999));

$errors = [];

// form validation
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

// redirect back to the page if the form data do not passed the checks
if (!empty($errors)) {
    Session::flash('old', [
        'email' => $_POST['email'],
        'name' => $_POST['name'],
        'password' => $_POST['password'],
        'passwordConfirm' => $_POST['password_confirmation']
    ]);

    Session::flash('errors',
        $errors);

    redirect('/register');
}

// checks if the email exist
$user = $db->query('SELECT email FROM users WHERE email = :email LIMIT 1', ['email' => $email])->get();
if ($user) {
    $errors['email'] = 'user already exist';
    Session::flash('errors',
        $errors);
    redirect('/register');
}

// save the user in a table for verification
$db->query('INSERT INTO email_verifications (username, password, email, token, otp) VALUES (:username, :password, :email, :token, :otp)',
    [   'username' => $name,
        'password' => password_hash($password, PASSWORD_BCRYPT),
        'email' => $email,
        'token' => $token,
        'otp' => $code
        ]);

// send the Code
$mail->sendOtp($email, $name, $code);

// redirect the user with unique token if successfully completed steps above
redirect("/verify_email?token={$token}");
?>