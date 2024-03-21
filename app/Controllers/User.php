<?php

require_once getcwd() . '/app/Helpers/RequestHelper.php';

class User extends Controller {
     /**
      * {@inheritDoc}
      * @see ControllerBase::getRoutes()
      */
     public function getRoutes(): array
     {
         // TODO Auto-generated method stub
         return ['users/getAll' => ['method' => 'GET', 'handler' => [$this, 'viewAllUsers']]];
     }
     
     public function viewAllUsers($requestMethod) {
        $users = $this->model("usermodel")->getAllUsers();
        return RequestHelper::respond(200, "Successfully gotten all users", $users);
     }
     
     public function createUser() {
             
     }
}