<?php

use Http\Forms\LoginForm;
use Core\Authenticator;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {
    $auth = new Authenticator();

    if ($auth->attempt($email, $password)) {

        redirect('/');
    }

    $form->error('email','No matching account found that email address and password.');

}

view('session/create.view.php', [
    'errors' => $form->errors()
]);