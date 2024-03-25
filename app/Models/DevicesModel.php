<?php

class DevicesModel extends Database {
    public function getAllDevices() {
      return $this->connect()->readAll("devices");
    }
    
    public function getSingleDevice($deviceId) {
        return  $this->connect()->filterById("devices", $deviceId)[0];
    }
}