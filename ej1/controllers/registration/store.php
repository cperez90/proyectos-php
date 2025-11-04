<?php

use Core\Validator;
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

//validate the form inputs
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

//check if the account already exists
$user = $db->query('select * from user where email = :email', [
    'email' => $email
])->find();
    // then someone with that email already exist and has an account.
    // if yes, redirect to a login page.
if ($user){
    header('location: /');
    exit();
}else {
    // if not, save one to the database, and then log the user in, and redirect.
    $db->query('INSERT INTO user(password, email) VALUES(:password, :email)',[
        'email' => $email,
        'password' => password_hash($password,PASSWORD_BCRYPT)
    ]);

    login($user);

    header('location: /');
    exit();
}

