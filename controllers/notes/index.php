<?php

use Core\Database;

$db = new Database();

$user = $db->query('SELECT id FROM users WHERE email = :email', ['email' => $_SESSION['user']['email']])->get();
$notes = $db->query('SELECT * FROM notes WHERE user_id = :user_id', ['user_id' => $user['id']])->getAll();
// $config = require base_path('config.php');
// $db = new Database($config['database']);

// $currentUser = $db->query('select * from users where email = :email',
//     [
//         'email' => $_SESSION['user']['email']
//     ])->find();

// $notes = $db->query('select * from notes where user_id = :user_id', [
//     'user_id' => $currentUser['id']
// ])->get();

// // dd($notes);

// // dd($currentUser);
// foreach ($notes as $note) {
//     authorize($note['user_id'] === $currentUser['id']);
// }

view('notes/index.view.php', 
[
    'notes' => $notes
]
);

?>





