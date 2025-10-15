<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routers = [
    '/ej1/' => 'controllers/index.php',
    '/ej1/about' => 'controllers/about.php',
    '/ej1/notes' => 'controllers/notes.php',
    '/ej1/note' => 'controllers/note.php',
    '/ej1/contact' => 'controllers/contact.php',
];

function routeToController($uri,$routers)
{
    if (array_key_exists($uri,$routers)){
        require $routers[$uri];
    }else {
        abort();
    }
}

function abort($code = 404){
    http_response_code($code);
    require "views/{$code}.php";

    die();
}

routeToController($uri,$routers);