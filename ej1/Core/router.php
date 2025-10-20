<?php



function routeToController($uri,$routers)
{
    if (array_key_exists($uri,$routers)){
        require base_path($routers[$uri]);
    }else {
        abort();
    }
}

function abort($code = 404){
    http_response_code($code);
    require base_path("views/{$code}.php");

    die();
}

$routes = require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

routeToController($uri,$routes);