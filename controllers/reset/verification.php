<?php declare(strict_types=1);

use Core\Email\Email;
use Core\Mailer\Mailer;
use Core\Database;
use Core\Session;
use Core\Validator;

$db = new Database();
$mailer = new Mailer();
$email = trim($_POST['email']);
$token = md5((string) rand());

$validator = new Validator();

//validate the email
$validator->validateAll(email:$email);


if (! empty($validator->errors())) {
    Session::flash('errors', $validator->errors());
    redirect('/reset');
}


$user = Email::isEmailExist($email);

//redirect to same page if no user is found
if (!$user || !$user['email_verified']) {
    Session::flash('errors', [
        'user' => 'User does not exist'
    ]);
    redirect('/reset');
}

// insert to password_reset table if user is found.
$db->query('INSERT INTO password_reset (email, token, time_expires) VALUES (:email, :token, :time_expires)', ['email' => $user['email'], 'token' => $token, 'time_expires' => date('Y-m-d H:i:s', time() + 900)]);

$mailer->send($user['email'], $user['username'], token: $token);

//create a session for password reset
Session::put('email', $email);
Session::put('passwordReset', 'true');

redirect("/password_reset?token={$token}");
?>