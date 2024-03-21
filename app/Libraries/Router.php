<?php

require_once getcwd() . '/app/Interfaces/ControllerBase.php';
require_once getcwd() . '/app/Helpers/RequestHelper.php';

class Router {
    private $routes = [];
    
    private int $statusCode = 503;
    private string $message;
    private $payload = [];
    
    public function __construct(){
        $this->registerRoutes();
    }
    
    public function loadController(ControllerBase $controller){
        $controllerRoutes = $controller->getRoutes();
        
        foreach ($controllerRoutes as $route => $handler) {
            $this->routes[$route] = $handler;
        }
    }
    
    public function registerRoutes() {   
        require_once getcwd() . '/app/Controllers/User.php';
        
        $this->loadController(new User());
    }
    
    public function renderContent($currentUri, $currentMethod, $currentBody, $currentParams) {
        try {
            if(!isset($this->routes[$currentUri])) {
                $this->statusCode = 404;
                $this->message = " Not Found";
                throw new Exception("Route not found");
            }
            
            if(!is_callable($this->routes[$currentUri]['handler'])){
                $this->statusCode = 501;
                $this->message = " Not Implemented";
                throw new Exception("Method not implemented");
            }
            
            if(($currentMethod === 'POST' || $currentMethod === 'PUT' || $currentMethod === 'PATCH')  && !$currentBody) {
                $this->statusCode = 400;
                $this->message = " Bad request";
                throw new Exception("When making post, put or patch requests, a body is required");
            }
            
            $route = $this->routes[$currentUri];
            
            $expectedMethod = strtoupper($route['method']);
            
            if ($currentMethod !== $expectedMethod) {
                $this->statusCode = 405;
                $this->message = " Method Not Allowed";
                throw new Exception("Method not allowed for this route");
            }

            $route['handler']($currentMethod, $currentBody, $currentParams);
        } catch (Exception $e) {
            $this->message = $e->getMessage();
            header("HTTP/1.0 " . $this->statusCode . $this->message);
            RequestHelper::respond($this->statusCode, $this->message, $this->payload);
        }
    }
}