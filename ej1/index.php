<?php

require 'functions.php';

//require 'router.php';

require 'Database.php';

$config = require('config.php');

$db = new Database($config['database']);

$posts = $db->query("SELECT * FROM post")->fetchAll();

dd($posts);


/*class Person{
    public $name;
    public $age;

    public function breathe(){

        echo $this->name.'is breathing!';
    }
}

$person = new Person();

$person->name = 'John Doe';
$person->age = 25;

$person->breathe();*/