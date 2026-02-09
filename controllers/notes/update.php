<?php declare(strict_types=1);

use Core\Database;
use Core\Validator;
use Core\Session;

$id = $_POST['id'];
$body = $_POST['body'];

$db = new Database();

if (!Validator::string($body, 1)) {
    Session::flash('errors', ['body' => 'a body should have at least 1 character']);
    redirect("/notes/edit?id={$id}");
}


$db->query('UPDATE notes INNER JOIN users on notes.user_id = users.id set body = :body WHERE notes.id = :id AND email = :email;',
    [
        'id' => $id,
        'body' => $body,
        'email' => $_SESSION['user']['email']
    ]
);


echo "
    <script>
    alert('notes have been updated');
    window.location.href = '/notes/all';
    </script>
";
