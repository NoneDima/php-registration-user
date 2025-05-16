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

            $email = $_POST["email"];
            $password = $_POST["password"];

            $errors = \app\Controllers\ValidationController::validateAuthUser($email, $password);

            if(is_array($errors)){
                header('Content-Type: text/json; charset=UTF-8');
                
                echo json_encode($errors);
                return false;
            }

            \app\Controllers\RegistrationController::authenticateUser();

            header('Location: http://localhost:9020/welcome');
        },
        '/register' => function() {
            wrapper('app/Controllers/RegistrationController.php')();
            wrapper('app/Controllers/ValidationController.php')();

            $fullname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $phone = $_POST["phone"];

            $errors = \app\Controllers\ValidationController::validateRegisterUser($fullname, $lastname, $email, $password, $phone);

            if(is_array($errors)){
                header('Content-Type: text/json; charset=UTF-8');
                
                echo json_encode($errors);
                return false;
            }

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