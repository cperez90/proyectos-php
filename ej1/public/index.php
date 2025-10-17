<?php

const BASE_PATH = __DIR__.'/../';

require BASE_PATH.'functions.php';

require base_path('Database.php');

require base_path('Response.php');

require base_path('router.php');

/*$id = $_GET['id'];

$query = "SELECT * FROM post where id = :id";

$posts = $db->query($query,[':id' => $id])->fetch();

dd($posts);*/


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