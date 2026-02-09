<?php declare(strict_types=1);

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$validator = new Validator();

if (!$validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'a body of no more than 1000 characters is required';
}

if (!empty($errors)) {
    view('notes/create.view.php', [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);

    return;
}

$user = $db->query('select * from users where email = :email', [
    'email' => $_SESSION['user']['email']
])->find();


// dd($user);
// authorize($note['user_id'] ?? false === $currentUser);

if (isset($user)) {
    $db->query('insert into notes (body, user_id) values (:body, :user_id)', [
        'body' => $_POST['body'],
        'user_id' => $user['id']
    ]);
}


header('location: /notes');

?>