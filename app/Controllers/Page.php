<?php

class Page extends Controller {
    
    /**
     * {@inheritDoc}
     * @see ControllerBase::getRoutes()
     */
    public function getRoutes(): array
    {
        // TODO Auto-generated method stub
        return [
            'home' => [$this, 'index'], 
            'devices' => [$this, 'devices'],
            'ranking' => [$this, 'ranking'],
            'devices/(\d+)' => [$this, 'singleDevice'],
            'notFound' => [$this, 'notFound'], 
            'serverError' => [$this, 'serverError']
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
}