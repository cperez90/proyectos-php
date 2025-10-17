<?php

$config = require('config.php');

$db = new Database($config['database']);

$heading = "My Notes";

$notes = $db ->query('SELECT * FROM note WHERE user_id=1;')->get();



view("index.view.php", [
    'heading' => 'My Notes'
]);