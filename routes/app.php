<?php

$obj_url = parse_url($_SERVER['REQUEST_URI']);

function wrapper($file_path){
    return fn() => require "$file_path";
}

try {
    $routes = [
        '/hello' => wrapper('app/Views/Hello/index.php'),
        '/login' => function() {
            header('Content-Type: text/html; charset=UTF-8');
            
            wrapper('app/Controllers/RegistrationController.php')();

            \app\Controllers\RegistrationController::showLoginForm();
        },
        '/welcome' => function() {
            header('Content-Type: text/html; charset=UTF-8');

            wrapper('app/Views/Welcome/index.php')();
        },
        '/registration' => function() {
            header('Content-Type: text/html; charset=UTF-8');
            
            wrapper('app/Controllers/RegistrationController.php')();

            \app\Controllers\RegistrationController::showRegistrationForm();
        },
        '/auth' => function() {
            wrapper('app/Controllers/RegistrationController.php')();

            \app\Controllers\RegistrationController::authenticateUser();

            header('Location: http://localhost:9020/welcome');
        },
        '/register' => function() {
            wrapper('app/Controllers/RegistrationController.php')();

            \app\Controllers\RegistrationController::registerUser();

            header('Location: http://localhost:9020/welcome');
        },
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