<?php
declare(strict_types=1);


$router->get('/', 'controllers/index.php');
$router->get('/register', 'controllers/registration/create.php');
$router->post('/register', 'controllers/registration/store.php');
// $router->get('/login', 'controllers/index.php');

?>