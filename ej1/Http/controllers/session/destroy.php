<?php


use Core\App;
use Core\Authenticator;

$auth = App::resolve(Authenticator::class);

$auth->logout();

header('location: /');
exit();