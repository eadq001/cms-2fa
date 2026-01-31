<?php declare(strict_types=1);

use Core\Database;

$db = new Database;

$otp = [$_POST['otp-1'], $_POST['otp-2'], $_POST['otp-3'], $_POST['otp-4'], $_POST['otp-5'], $_POST['otp-6']];
$otp = (int) implode($otp);

$token = $_GET['token'];

$verify = $db->query('SELECT * FROM email_verifications where token = :token LIMIT 1', ['token' => $token])->get();

if (!$verify) {
    redirect('/register');
}
?>