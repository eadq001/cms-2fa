<?php declare(strict_types=1);

// check if the email exist in email_verifications table
// if exist then check the otp code creation date and time
// delete otp code if expired
// if not expired redirect the temporary user to verification page with his token as link

use Core\Database;
use Core\Session;
use Core\Validator;
use Core\Mailer\Mailer;

$db = new Database;
$mail = new Mailer();
$validator = new Validator();

//get the user's input, generate token and otp.
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$passwordConfirm = $_POST['password_confirmation'];
$token = md5((string) rand());
$code = sprintf('%06d', random_int(0, 999999));

// checks all the forms if it is valid
$validator->validateAll($username, $email, $password, $passwordConfirm);

// redirect back to the page if the form data do not passed the checks
if (!empty($validator->errors())) {
    Session::flash('old', [
        'email' => $_POST['email'],
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'passwordConfirm' => $_POST['password_confirmation']
    ]);

    Session::flash('errors',
        $validator->errors());

    redirect('/register');
}

// checks if the email exist
$user = $db->query('SELECT email FROM users WHERE email = :email LIMIT 1', ['email' => $email])->get();
if ($user) {
    $errors = ['user' => 'user already exist'];

    Session::flash('old', [
        'email' => $_POST['email'],
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'passwordConfirm' => $_POST['password_confirmation']
    ]);

    Session::flash('errors',
        $errors);
    redirect('/register');
}

// check the email if it has entry for verification
$emailVerification = $db->query('SELECT email, created_at, token, time_expires FROM email_verifications WHERE email = :email LIMIT 1', ['email' => $email])->get();
if ($emailVerification) {
    // check if the otp code already expired
    if (date('Y-m-d H:i:s') >= $emailVerification['time_expires']) {
        // delete the row
        $db->query('DELETE FROM email_verifications WHERE email = :email', ['email' => $emailVerification['email']]);
    } else {
        redirect("/verify_email?token={$emailVerification['token']}");
    }
}

// save the user in a table for verification
$db->query('INSERT INTO email_verifications (username, password, email, token, otp, created_at, time_expires) VALUES (:username, :password, :email, :token, :otp, :created_at, :time_expires)',
    ['username' => $username,
        'password' => password_hash($password, PASSWORD_BCRYPT),
        'email' => $email,
        'token' => $token,
        'otp' => $code,
        'created_at' => date('Y-m-d H:i:s'),
        'time_expires' => date('Y-m-d H:i:s', +time() + 900)]);

// send the Code
$mail->sendOtp($email, $username, $code);

// redirect the user with unique token if successfully completed steps above
redirect("/verify_email?token={$token}");
?>