<?php declare(strict_types=1);

use Core\Database;
use Core\Session;

$token = $_POST['token'];

$otp = [$_POST['otp-1'], $_POST['otp-2'], $_POST['otp-3'], $_POST['otp-4'], $_POST['otp-5'], $_POST['otp-6']];
$otp = trim(implode($otp));  // combines all the value in the 6 input forms into 1

$db = new Database();

$user = $db->query('SELECT email, time_expires, otp, attempts, token FROM otp_verifications WHERE token = :token LIMIT 1  ', ['token' => $token])->get();

// check if the otp is expired
if ($user['time_expires'] <= date('Y-m-d H:i:s')) {
    $db->query('DELETE FROM otp_verifications WHERE email = :email', ['email' => $user['email']]);
}

if (!$user) {
    echo "
    <script>
    alert('otp is expired. please try again');
    window.location.href = '/login';
    </script>
    ";
}

$userAttempts = null;

if ($otp !== $user['otp']) {
    $db->query('UPDATE otp_verifications SET attempts = attempts - 1 WHERE email = :email', ['email' => $user['email']])->get();
    //update the user attempts based on the value of the database
    global $userAttempts;
    $userAttempts = $db->query('SELECT attempts FROM otp_verifications WHERE token = :token LIMIT 1  ', ['token' => $token])->get();

    Session::flash('errors', ['attempts' => "You have {$userAttempts['attempts']} attempts left"]);

    redirect("/login/otp/verification?token={$token}");
}

if ($userAttempts === 0) {
    $db->query('DELETE FROM otp_verifications WHERE email = :email', ['email' => $user['email']]);
}

// check the otp if correct
$verifiedUser = $db->query('SELECT * FROM otp_verifications WHERE email = :email and otp = :otp', ['email' => $user['email'], 'otp' => $otp])->get();

// clears current session and add a new one for the auth middleware
Session::flush();
Session::put('user', ['email' => $user['email']]);
Session::put('logged_in', true);

if ($verifiedUser) {
    $db->query('DELETE FROM otp_verifications WHERE email = :email', ['email' => $user['email']]);
    redirect('/home');
}

?>

