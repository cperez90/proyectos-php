<?php

use Core\Database;

$config = require base_path('config.php');

$db = new Database($config['database']);

$currentUserId = 1;


$note = $db ->query('SELECT * FROM note WHERE id= :id',[
    'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$db ->query('delete from note where id = :id',[
    'id' => $_POST['id']
]);

header('location: /notes');
exit();


