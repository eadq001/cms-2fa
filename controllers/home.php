<?php
declare(strict_types=1);

use Core\Database;
$db = new Database();
$username = $db->query('SELECT username FROM users where email = :email', ['email' => $_SESSION['user']['email']])->get();

view('home.view.php', 
[
    'username' => $username['username']
]);
