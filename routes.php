<?php
declare(strict_types=1);


$router->get('/', 'controllers/index.php');

$router->get('/register', 'controllers/registration/create.php');
$router->post('/register', 'controllers/registration/store.php');

$router->get('/login', 'controllers/login/create.php');
$router->post('/login', 'controllers/login/store.php');

$router->get('/reset', 'controllers/reset/create.php');
$router->post('/reset', 'controllers/reset/verification.php');

$router->get('/verify_email', 'controllers/registration/verifyEmailPage.php');
$router->post('/verify_email', 'controllers/registration/verification.php');
// $router->get('/login', 'controllers/index.php');

?>