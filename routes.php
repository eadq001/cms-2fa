<?php
declare(strict_types=1);


$router->get('/', 'controllers/index.php');

$router->get('/register', 'controllers/registration/create.php');
$router->post('/register', 'controllers/registration/store.php');
$router->get('/verify_email', 'controllers/registration/verifyEmailPage.php');
$router->post('/verify_email', 'controllers/registration/verifyEmail.php');
// $router->get('/login', 'controllers/index.php');

?>