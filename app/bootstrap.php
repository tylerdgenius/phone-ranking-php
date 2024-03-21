<?php
//Require Config File

spl_autoload_register(function($className){
    require_once 'Libraries/' . $className . '.php';
});