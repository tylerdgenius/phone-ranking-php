<?php

require_once CLIENT_CONTROLLERS . "Page.php";

class Router {
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

            foreach ($this->routes as $routePattern => $handler) {
                if (preg_match("~^$routePattern$~", $url, $matches)) {
                    if (isset($matches[1])) {
                        $params['id'] = $matches[1];
                        return $handler($params);
                    } else {
                        return $handler($params);
                    }
                }
            }
            
            if(!isset($this->routes[$url])){
                $route = $this->routes['notFound'];
                return $route($params);
            }
        } catch (Exception $e) {
            echo "SErver error";
            $route = $this->routes['serverError'];
            return $route($params);
        }
    }
}