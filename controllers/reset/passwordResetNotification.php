<?php declare(strict_types=1);

use Core\Token\Token;

$token = $_GET['token'];
$checkToken = new Token();

$user = $checkToken->checkTokenExpiry($token);

view('reset/passwordResetNotification.view.php',
    [
        'email' => $user['email']
    ]);

// sleep(10);

// redirect('/login');

?>