<?php
declare(strict_types=1);

session_start();

use Core\Router;
const BASE_PATH = __DIR__ . '/../';
require BASE_PATH . 'env.php';

require '../vendor/autoload.php';

require '../functions.php';

$router = new Router();
require BASE_PATH . 'routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];
dd($_ENV);
$router->route($uri, $method);


// require("views/partials/header.php");
// require("views/partials/footer.php");

?>