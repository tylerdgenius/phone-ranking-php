<?php

require_once INTERFACES . 'ControllerBase.php';

class Controller implements ControllerBase {
    public function model($model) {
        require_once API_MODELS . $model . '.php';
        
        return new $model();
    }
    
    public function view($view, $layoutType, $data = []) {
        try {
            if(!file_exists(CLIENT_PAGES . $view . '.php')) {
                throw new Exception("Unable to find view in the resource folder");
            }
            
            if(!$layoutType) {
                return require_once CLIENT_PAGES . $view . '.php';
            }
            
            require_once CLIENT_CONTROLLERS . 'Layout.php';
            
            if($layoutType == "Default") {
                return Layout::renderDefaultLayout(strtoupper($view), $data);
            }
        } catch (Exception $e) {
            require_once CLIENT_PAGES . '503.php';
        }
    }
    
    public function getRoutes(): array
    {
    }
}