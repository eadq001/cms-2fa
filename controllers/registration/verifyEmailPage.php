<?php declare(strict_types=1);

use Core\Token\Token;

$token = new Token;

$user = $token->checkTokenExpiry($_GET['token']);

if (!$user) {
    redirect('/register');
} else {
    view('registration/verifyEmailPage.view.php',
        [
            'email' => $user['email']
        ]);
}

?>