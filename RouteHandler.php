<?php

    class RouteHandler {

        private $routes;
        public $REQUEST_URI;

        function __construct() {
            $this->REQUEST_URI = explode('/', $_SERVER['REQUEST_URI']);
        }

        function register($routes){
            $this->routes = $routes;
        }

        function route() {
            $requested_route = $this->REQUEST_URI[1];
            foreach($this->routes as $route){
                if($route->match($requested_route)){
                    $route->outlet();
                } else {
                    header("HTTP/1.1 404 Not Found");
                    echo '404';
                }
            }
        }

    }

?>