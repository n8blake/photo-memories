<?php

    class Route {

        private $url;
        private $script;

        function __construct($route, $script = 'default'){
            $this->url = $route;
            $this->scritp = $script;
        }

        function match($str){
            return $this->url === $str;
        }

        function outlet() {
            if($this->script === 'default'){
                try {
                    include 
                }
            }
        }

    }

?>