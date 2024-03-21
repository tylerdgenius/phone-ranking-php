<?php

require_once getcwd() . '/app/Interfaces/ControllerBase.php';

class Controller implements ControllerBase {
    public function getRoutes(): array
    {}

    public function model($model) {
        require_once getcwd() . '/app/Models/' . $model . '.php';
        
        return new $model();
    }
}