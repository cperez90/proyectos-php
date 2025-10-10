<?php

require 'functions.php';

//require 'router.php';

require 'Database.php';

$config = require('config.php');

$db = new Database($config['database']);

$id = $_GET['id'];

$query = "SELECT * FROM post where id = :id";

$posts = $db->query($query,[':id' => $id])->fetch();

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