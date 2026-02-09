<?php

use Core\Database;

$db = new Database();

$id = $_GET['id'];

$note = $db->query('SELECT notes.id, body, username from notes INNER JOIN users on notes.user_id = users.id where notes.id = :id AND email = :email;', ['id' => $id, 'email' => $_SESSION['user']['email']])->get();

view('notes/show.view.php', [
    'note' => $note,
]);

?>





