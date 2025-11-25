<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Dao\NotesDaoImpl;
use Core\Dao\NotesDao;

$container = new Container();

$container->bind('Core\Database',function (){
    $config = require base_path('config.php');
    return new Database($config['database']);
});

$container->bind(NotesDAO::class, function ($container) {
    return new NotesDaoImpl($container->resolve('Core\Database'));
});

App::setContainer($container);