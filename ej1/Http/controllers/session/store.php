<?php

//log in the user if the credentials match.

use Core\Validator;
use Core\App;
use Core\Database;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if (! $form->validate($email, $password)) {
    view('session/create.view.php', [
        'errors' => $form->errors()
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



