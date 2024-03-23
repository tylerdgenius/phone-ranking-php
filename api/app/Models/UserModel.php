<?php

class UserModel extends Database {
    public function getAllUsers() {
      return $this->connect()->readAll("users");
    }
}