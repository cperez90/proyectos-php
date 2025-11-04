<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 1;

$note = $db ->query('SELECT * FROM note WHERE id= :id',[
    'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$errors = [];

if (! Validator::string($_POST['body'], 1,1000)){
    $errors['body'] = 'A body of no more 1,000 characters is required';
}

if (count($errors)) {
     view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

$db->query('update note set body = :body where id = :id',[
    'id' => $_POST['id'],
    'body' => $_POST['body']
]);

header('location: /notes');
die();