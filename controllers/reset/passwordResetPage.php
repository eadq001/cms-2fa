<?php declare(strict_types=1);

use Core\Token\Token;

$token = $_GET['token'];
$checkToken = new Token();
$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// $_SESSION = [];

$user = $checkToken->checkTokenExpiry($token);

// redirect("password_reset_page?token={$token}");

if (!$user) {
    redirect('/login');
}

if (!$_SESSION['passwordReset'] && !$_SESSION['email']) {
    redirect('/login');
}

view('reset/passwordResetPage.view.php');

?>