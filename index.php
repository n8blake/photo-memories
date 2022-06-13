<?php

    //report errors for debugging...
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
    
    const APP_NAME = 'photo-memories';

    require_once 'Router.php';
    require_once 'Request.php';

    session_start();
    
    $request = new Request;
    $router = new Router($request);

    $router->get('/login', function(){
        if(isset($_SESSION['user'])){
            echo 'Hello';
        } else {
            header("{$_SERVER['SERVER_PROTOCOL']} 401 Unauthorized");
        }
    });

    $router->get('/login/:code', function(){
        
    });

    $router->post('/login', function($request){
        echo json_encode($request->getBody());
    });
        
?>


