<?php declare(strict_types=1);

use Core\Token\Token;

$token = new Token;

if (!$token->checkTokenExpiry($_GET['token'])) {
    redirect('/register');
} else {
    view('registration/verifyEmailPage.view.php');
}

?>