<?php declare(strict_types=1);

use Core\Authenticator;
use Core\Email\Email;
use Core\Mailer\Mailer;
use Core\Database;
use Core\Session;
use Core\Validator;
use Core\Token\Token;


$tokenObj = new Token();
$db = new Database();
$mailer = new Mailer();
$email = trim($_POST['email']);
$token = md5((string) rand());

$validator = new Validator();

//validate the email
if (!Validator::email($email)) {
    $validator->setErrors('email', 'please enter a valid email address');
}

//deletes the user otp verification if he tried to password reset at the same time
$db->query('DELETE FROM otp_verifications WHERE email = :email', ['email' => $email]);

$user = $db->query('SELECT * FROM password_reset where email = :email LIMIT 1', ['email' => $email])->get();

$checkToken = $tokenObj->checkTokenExpiry($user['token']);

if($checkToken) {
    Session::flash('errors', ['user' => 'User has a pending password reset link, it has 15 mins validaty.']);
    redirect('/reset/password/form');
}


if (! empty($validator->errors())) {
    Session::flash('errors', $validator->errors());
    redirect('/reset/password/form');
}


$user = Email::isEmailExist($email);

//redirect to same page if no user is found
if (!$user || !$user['email_verified']) {
    Session::flash('errors', [
        'user' => 'User does not exist'
    ]);
    redirect('/reset/password/form');
}

// insert to password_reset table if user is found.
$db->query('INSERT INTO password_reset (email, token, time_expires) VALUES (:email, :token, :time_expires)', ['email' => $user['email'], 'token' => $token, 'time_expires' => date('Y-m-d H:i:s', time() + 900)]);

$mailer->send($user['email'], $user['username'], token: $token);

//create a session for password reset
Authenticator::passwordReset($email);

redirect("/reset/password/notification?token={$token}");
?>