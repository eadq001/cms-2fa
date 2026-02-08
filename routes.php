<?php
declare(strict_types=1);


$router->get('/', 'controllers/index.php')->only('guest');

$router->get('/register', 'controllers/registration/create.php')->only('guest');
$router->post('/register', 'controllers/registration/store.php');

$router->get('/login', 'controllers/login/create.php')->only('guest');
$router->post('/login', 'controllers/login/store.php');
$router->get('/login/otp/verification', 'controllers/login/verificationPage.php')->only('verification');
$router->post('/login/otp/verification', 'controllers/login/verificationOTp.php');

$router->get('/reset/password/form', 'controllers/reset/searchForm.php')->only('guest');
$router->post('/reset/password/request', 'controllers/reset/search.php');
$router->get('/reset/password/notification', 'controllers/reset/passwordResetNotification.php')->only('passwordReset');
$router->get('/reset/password/user/form', 'controllers/reset/passwordResetPage.php')->only('passwordReset');
$router->post('/reset/password/user/update', 'controllers/reset/store.php');

$router->get('/register/email/verification', 'controllers/registration/emailVerificationPage.php')->only('guest');
$router->post('/register/email/verification', 'controllers/registration/verification.php');

$router->get('/home', 'controllers/home.php')->only('auth');

$router->delete('/logout', 'controllers/logout/logout.php');


?>