<?php
declare(strict_types=1);

session_start();
date_default_timezone_set('Asia/Manila');

use Core\Router;
const BASE_PATH = __DIR__ . '/../';
require BASE_PATH . 'env.php';

require '../vendor/autoload.php';

require '../functions.php';

$router = new Router();
require BASE_PATH . 'routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];
$router->route($uri, $method);
// dd($_SESSION);
\Core\Session::unflash();



?>