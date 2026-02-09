<?php declare(strict_types=1);

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

$errors = [];

$validator = new Validator();

if (!$validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = "a body of no more than 1000 characters is required";
}

$currentUser = 1;


if(count($errors)) {
    return view('/notes/edit.view.php', [
        'heading' => 'Update Note',
        'errors' => $errors,
        'note' => $note,
        'pageTitle' => 'Edit Notes'

    ]);
}

authorize($note['user_id'] === $currentUser);

$db->query('update notes set body = :body where id = :id', [
    'body' => $_POST['body'],
    'id' => $_POST['id']
]);

header('location: /notes');
die();

?>