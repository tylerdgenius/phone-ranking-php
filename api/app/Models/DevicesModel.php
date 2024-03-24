<?php

class DevicesModel extends Database {
    public function getAllDevices() {
      return $this->connect()->readAll("devices");
    }
}