<?php

use Core\App;
use Core\Database;


$db = App::resolve(Database::class);
$currentUser = 1;


$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUser);

$user = $db->query("select * from users where id = {$note['user_id']}")->find();

$db->query('delete from notes where id = :id', [
    'id' => $_POST['id']
]);

header("location: /notes");
die();
?>