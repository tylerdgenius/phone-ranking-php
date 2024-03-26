<?php

class DevicesModel extends Database {
    public function getAllDevices() {
      return $this->connect()->readAll("devices");
    }
    
    public function getSingleDevice($deviceId) {
        return $this->connect()->filterById("devices", $deviceId)[0];
    }

    public function sortDevicesByName() {
      $devices = $this->getAllDevices();

      usort($devices, function($a, $b) {
          return strcmp($a['name'], $b['name']);
      });

      return $devices;
    }

    public function sortDevicesByBatterySize() {
      $devices = $this->getAllDevices();

      usort($devices, function($a, $b) {
          return strcmp($a['batteryType'], $b['batteryType']);
      });

      return $devices;
    }
}