<?php

require 'functions.php';

//require 'router.php';

require 'Database.php';

$db = new Database();

$posts = $db->query("SELECT * FROM post")->fetchAll(PDO::FETCH_ASSOC);

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