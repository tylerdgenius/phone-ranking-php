<?php

class Page extends Controller {
    
    /**
     * {@inheritDoc}
     * @see ControllerBase::getRoutes()
     */
    public function getRoutes(): array
    {
        return [
            'home' => [$this, 'index'], 
            'devices' => [$this, 'devices'],
            'ranking' => [$this, 'ranking'],
            'login' => [$this, "login"],
            'register' => [$this, "register"],
            'notFound' => [$this, 'notFound'], 
            'serverError' => [$this, 'serverError'],
            'devices/(\d+)' => [$this, 'singleDevice'],
        ];
    }
    
    public function index($params) {
       $this->view("Home", "Default");
    }
    
    public function singleDevice($params) {
        $this->view("SingleDevice", "Default", $params);
    }
    
    public function devices($params) {
        $this->view("Devices", "Default");
    }

    public function ranking($params) {
        $this->view("Ranking", "Default");
    }
    
    public function notFound($params) {
       $this->view("NotFound", "Default");
    }
    
    public function serverError($params) {
        $this->view("ServerError", "Default");
    }

    public function register($params) {
        $this->view("Register", "Default");
    }

    public function login($params) {
        $this->view("Login", "Default");
    }
}