<?php

use Core\App;
use Http\Forms\LoginForm;
use Core\Authenticator;

$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$authenticator = App::resolve(Authenticator::class);

$signedIn = $authenticator->attempt(
    $attributes['email'], $attributes['password']
);

if (!$signedIn) {

    $form->error(
        'email','No matching account found that email address and password.'
    )->throw();

}

redirect('/');