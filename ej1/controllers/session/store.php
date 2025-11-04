<?php

//log in the user if the credentials match.

use Core\Validator;
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password)){
    $errors['password'] = 'Please provide a valid password';
}

if (! empty($errors)) {
    view('session/create.view.php', [
        'errors' => $errors
    ]);
}

$user = $db->query('select * from user where  email = :email', [
    'email' => $email
])->find();

if ($user) {
    if (password_verify($password, $user['password'])){
        login([
            'email' => $email
        ]);

        header('location: /');
        exit();
    }
}

view('session/create.view.php', [
    'errors' => [
        'email' => 'No matching account found that email address and password.'
    ]
    ]);



