<?php

require_once CLIENT_CONTROLLERS . "Page.php";

class ClientRouter {
    private $routes = [];
    
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
        $this->loadController(new Page());
    }
    
    public function renderContent($url, $params){
        try {
            if($url == null || $url == "home") {
              $route = $this->routes['home'];
              return $route($params);
            }
            
            if(!isset($this->routes[$url])){
                $route = $this->routes['notFound'];
                return $route($params);
            }
        } catch (Exception $e) {
            $route = $this->routes['serverError'];
            return $route($params);
        }
    }
}