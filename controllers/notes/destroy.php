<?php

use Core\Database;

$db = new Database();
$id = $_POST['id'];


$db->query('DELETE notes FROM notes INNER join users on notes.user_id = users.id where email = :email and notes.id = :id;', ['email' => $_SESSION['user']['email'], 'id' => $id])->get();

echo "
    <script>
    alert('note was deleted');
    window.location.href = '/notes/all';
    </script>
";

