<?php

require 'functions.php';

//require 'router.php';


//connect to our MYSQL
$dsn = "mysql:host=192.168.1.70;port=3306;user=admin;password=admin;dbname=mi_base;";

$pdo = new PDO($dsn);

$statement = $pdo->prepare("SELECT * FROM post");

$statement->execute();

$post = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($post as $po){
    echo "<li>".$po['title']."</li>";
}


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