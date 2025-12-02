<?php

use Core\Validator;
use Core\App;
use Core\Dao\UserDAO;

$userDao = App::resolve(UserDAO::class);

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

$user = $userDao->findByEmail($email);

if ($user){
    header('location: /');
    exit();
}else {

    $userDao->create([
        'email' => $email,
        'password' => $password
    ]);

    $user = $userDao->findByEmail($email);

    if (!$user) {
        throw new Exception("Error: No se pudo recuperar el usuario después del registro.");
    }

    (new Core\Authenticator())->login($user);

    header('location: /');
    exit();
}

