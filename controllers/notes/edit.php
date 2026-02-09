<?php declare(strict_types=1);

use Core\Database;

$db = new Database();
$id = $_GET['id'];
$note = $db->query('SELECT body, notes.id from notes INNER join users on notes.user_id = users.id where email = :email and notes.id = :id;', ['email' => $_SESSION['user']['email'], 'id' => $id])->get();

view('notes/edit.view.php',
['note' => $note]
);

?>