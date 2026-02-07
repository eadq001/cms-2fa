<?php
declare(strict_types=1);


$router->get('/', 'controllers/index.php')->only('guest');

$router->get('/register', 'controllers/registration/create.php');
$router->post('/register', 'controllers/registration/store.php');

$router->get('/login', 'controllers/login/create.php');
$router->post('/login', 'controllers/login/store.php');

$router->get('/forgot-password', 'controllers/reset/create.php');
$router->post('/forgot-password', 'controllers/reset/findYourAccount.php');

$router->get('/password_reset', 'controllers/reset/passwordResetNotify.php');
$router->post('/password_reset', 'controllers/reset/passwordResetNotify.php');

$router->get('/password_reset_page', 'controllers/reset/passwordResetPage.php');
$router->post('/password_reset_page', 'controllers/reset/store.php');

$router->get('/verify_email', 'controllers/registration/verifyEmailPage.php');
$router->post('/verify_email', 'controllers/registration/verification.php');

$router->get('/otp_verification', 'controllers/login/verification.php');
$router->post('/otp_verification', 'controllers/login/verificationOTp.php');

$router->get('/home', 'controllers/home.php')->only('auth');

?>