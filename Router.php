<?php

    class Router {
        private $request;
        private $supportedHttpMethods = array("GET", "POST");
    
        function __construct(IRequest $request){
            $this->request = $request;
        }

        function __call($name, $args){
            list($route, $method) = $args;
            if(!in_array(strtoupper($name), $this->supportedHttpMethods)){
                $this->invalidMethodHandler();
            }
            $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
        }
        
        private function formatRoute($route) {
            $result = rtrim($route, '/');
            if($result === '') {
                return '/';
            }
            return $result;
        }

        private function invalidMethodHandler() {
            header("{$this->request->serverProtocol} 405 Method Not Allowed");
        }

        private function defaultRequestHandler() {
            // header("{$this->request->serverProtocol} 404 Not Found");
            // echo '<h1>404!</h1>';
            if( isset($_REQUEST['path']) && file_exists(dirname(__FILE__) . '/'.APP_NAME.'/dist/'.APP_NAME.'/' . $_REQUEST['path'])){
                $file = dirname(__FILE__) . '/'.APP_NAME.'/dist/'.APP_NAME.'/' . $_REQUEST['path'];	
                if(strpos($_REQUEST['path'], '.js')){
                    header('Content-type: text/javascript');
                } else if(strpos($_REQUEST['path'], '.css')){
                    header('Content-type: text/css');
                } else {
                    $mimeType = mime_content_type($file);
                    header('Content-type: ' . $mimeType);
                }
                readfile($file);
            } else {
                include(dirname(__FILE__) . '/'.APP_NAME.'/dist/'.APP_NAME.'/index.html');
            }
        }

        /**
         * Resolves a route
         */
        function resolve()
        {
            $methodDictionary = $this->{strtolower($this->request->requestMethod)};
            $formatedRoute = $this->formatRoute($this->request->requestUri);
            var_dump($methodDictionary);
            if(isset($methodDictionary[$formatedRoute])){
                $method = $methodDictionary[$formatedRoute];
                echo call_user_func_array($method, array($this->request));
            } else {
                $this->defaultRequestHandler();
                return;
            }

            
        }

        function __destruct()
        {
            $this->resolve();
        }


    }

?>