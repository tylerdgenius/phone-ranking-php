<?php

/* App Client Core Loader
 * Creates URL & Loads Core Controller
 */

class Core {
    private $url;
    private $params = [];
    
    public function __construct(){
        $this->getData();
        $router = new Router();
        $router->renderContent($this->url, $this->params);
    }
    
    public function getData(){
        foreach ($_GET as $key => $value) {
            if($key == 'url') {
                $this->url = $this->sanitize($value);
                continue;
            }
            $this->params[$key] = $this->sanitize($value);
        }
    }
    
    public function sanitize($data){
        return filter_var(rtrim($data, '/'), FILTER_SANITIZE_URL);
    }
}