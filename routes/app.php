<?php

$obj_url = parse_url($_SERVER['REQUEST_URI']);

function wrapper($file_path){
    return fn() => require __DIR__."/../$file_path";
}

try {
    $routes = [
        '/hello' => wrapper('app/Views/Hello/HelloView.php'),
        '/registration' => wrapper('app/Views/Registration/RegistrationView.php'),
        '/css/style.css' => function() {
            header('Content-Type: text/css; charset=UTF-8');
            return wrapper('public/css/style.css')();
        },
    ];

    if(array_key_exists($obj_url['path'], $routes)){
        echo $routes[$obj_url['path']]();
    } else {
        header('Content-Type: text/html; charset=UTF-8');

        echo "Route not find:\n";
        print_r(parse_url($_SERVER['REQUEST_URI']));
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}