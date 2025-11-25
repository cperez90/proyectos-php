<?php

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

if (!Validator::string($password, 7 ,255)){
    $errors['password'] = 'Please provide a valid password';
}

if (! empty($errors)) {
    view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

$user = $db->query('select * from user where email = :email', [
    'email' => $email
])->find();

if ($user){
    header('location: /');
    exit();
}else {

    $db->query('INSERT INTO user(password, email) VALUES(:password, :email)',[
        'email' => $email,
        'password' => password_hash($password,PASSWORD_BCRYPT)
    ]);

    $user = $db->query('SELECT * FROM user WHERE email = :email', [
        'email' => $email
    ])->find();

    if (!$user) {
        throw new Exception("Error: No se pudo recuperar el usuario después del registro.");
    }

    (new Core\Authenticator())->login($user);

    header('location: /');
    exit();
}

