<?php

const BASE_PATH = __DIR__.'/../';

require BASE_PATH . 'Core/functions.php';

//require base_path('Database.php');

//require base_path('Response.php');

spl_autoload_register(function ($class){
    $class = str_replace('\\',DIRECTORY_SEPARATOR,$class);
    require base_path("{$class}.php");
});

$router = new Core\Router();

$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri,$method);

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