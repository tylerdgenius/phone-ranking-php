<?php

class Page extends ClientController {
    
    /**
     * {@inheritDoc}
     * @see ControllerBase::getRoutes()
     */
    public function getRoutes(): array
    {
        // TODO Auto-generated method stub
        return [
            'home' => [$this, 'index'], 
            'notFound' => [$this, 'notFound'], 
            'serverError' => [$this, 'serverError']
        ];
    }
    
    public function index($params) {
       $this->view("Home", "Default");
    }
    
    public function notFound($params) {
       $this->view("NotFound", "Default");
    }
    
    public function serverError($params) {
        $this->view("ServerError", "Default");
    }
}