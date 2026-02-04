<?php declare(strict_types=1);

use Core\Database;

$token = $_GET['token'];
$db = new Database();

$user = $db->query('SELECT email, time_expires, attempts FROM otp_verifications WHERE token = :token', ['token' => $token])->get();

// var_dump($user);
// dd($token);

if (!$user) {
    echo "
    <script>
    alert('otp is expired. please try again');
    window.location.href = '/login';
    </script>
    ";
}

// check if the otp is expired
if ($user['time_expires'] <= date('Y-m-d H:i:s')) {
    $db->query('DELETE FROM otp_verifications WHERE email = :email', ['email' => $user['email']]);
}

// check if the user attempts is 0
if ($user['attempts'] === 0) {
    \Core\Session::destroy();
    echo "
    <script>
    alert('You already used all your attempts to verify. please try to log in again.');
    window.location.href = '/login';
    </script>
    ";
    $db->query('DELETE FROM otp_verifications WHERE email = :email', ['email' => $user['email']]);
}

view('login/verificationOtp.view.php',
    ['email' => $user['email'],
        'token' => $token]);

?>