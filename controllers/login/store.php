<?php declare(strict_types=1);

use Core\Mailer\Mailer;
use Core\Authenticator;
use Core\Database;
use Core\Session;
use Core\Validator;

$db = new Database();
$authenticator = new Authenticator();
$validator = new Validator();
$mailer = new Mailer();

$email = $_POST['email'];
$password = $_POST['password'];
$token = md5((string) rand());
$otp = sprintf('%06d', random_int(0, 999999));

Session::flush();
// checks if the user exist. if it exist, checks the password if it match to the users password
$user = $authenticator->attemptLogin($email, $password);
if (!$user) {
    Session::flash('errors', ['user' => 'User does not exist']);
    redirect('/login');
}

// validate the forms
$validator->validateAll(email: $email, password: $password);
if (!empty($validator->errors())) {
    Session::flash('errors', $validator->errors());
    redirect('/login');
}

$userOtp = $db->query('SELECT time_expires, email, token FROM otp_verifications where email = :email', ['email' => $email])->get();
//checks if the otp is expired.

if ($userOtp['time_expires'] <= date('Y-m-d H:i:s')) {
    $db->query('DELETE FROM otp_verifications WHERE email = :email', ['email' => $userOtp['email']]);
}
else {
    echo "
    <script>alert('You have a pending OTP.');
    window.location.href = '/otp_verification?token={$userOtp['token']}';
    </script>
    ";
}


$db->query('INSERT INTO otp_verifications (email, otp, token, user_id, time_expires, attempts) VALUES (:email, :otp, :token, :user_id, :time_expires, :attempts
)',
    ['email' => $email,
        'otp' => $otp,
        'token' => $token,
        'user_id' => $user['id'],
        'time_expires' => date('Y-m-d H:i:s', time() + 900),
        'attempts' => 5]);

// Debug: Check if token was stored
$storedToken = $db->query('SELECT token FROM otp_verifications WHERE email = :email ORDER BY id DESC LIMIT 1', ['email' => $email])->get();

$db->query('DELETE FROM password_reset WHERE email = :email', ['email' => $email]);

$mailer->send($email, null, $otp);

redirect("/otp_verification?token={$token}");

?>