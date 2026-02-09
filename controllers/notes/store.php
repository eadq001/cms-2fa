<?php declare(strict_types=1);

use Core\App;
use Core\Database;
use Core\Session;
use Core\Validator;

//form validation
//user authorization
$id = (string) 1;

$short = base_convert($id, 32, 36);
dd($short);

$body = htmlspecialchars($_POST['body']);
$db = new Database();
$user = $db->query('SELECT id FROM users WHERE email = :email', ['email' => $_SESSION['user']['email']])->get();

if (!Validator::string($body, 1)) {
    Session::flash('errors', ['body' => 'a body should have at least 1 character']);
    redirect('/notes/create');
}

$db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', ['body' => $body, 'user_id' => $user['id']]);



header('location: /notes/all');
