<?php

/* Api Core Controller
 * Creates URL & Loads Core Controller
 * URL Format /controller/method/params
 */

class Core{
    public function __construct(){
        $uri = $this->getUrl();
        $method = $this->getRequestMethod();
        
        $router = new Router();
        
        $body = file_get_contents("php://input") ? file_get_contents("php://input") : [];
        
        $params = explode("?", $uri) ? explode("?", $uri) : [];
        
        $router->renderContent($uri, $method, $body, $params);
    }
    
    public function getRequestMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }
    
    public function getUrl(){ 
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return $url;
        }
    }
}