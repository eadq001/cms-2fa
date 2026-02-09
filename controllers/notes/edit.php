<?php declare(strict_types=1);

// use Core\App;
// use Core\Database;

// $db = App::resolve(Database::class);
// $note = $db->query('select * from notes where id = :id',
// [
//     'id' => $_GET['id']
//     ])->find();

// $currentUser = 1;

    
// authorize($note['user_id'] === $currentUser);

view('notes/edit.view.php'
);

?>