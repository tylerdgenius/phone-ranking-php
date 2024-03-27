<?php

require_once MODELS . 'UserReviewModel.php';

class DevicesModel extends Database {
    private UserReviewModel $userReviewModel;

    public function __construct() {
      $this->userReviewModel = new UserReviewModel();
    }

    public function getAllDevices() {
      $devices = $this->connect()->readAll("devices");

      $finalDevices = [];

      foreach ($devices as $device) {
          if(isset($device['id'])) {
            $userReviewRatings = $this->userReviewModel->findRatingsByDeviceId($device['id']);

            if(isset($userReviewRatings) && count($userReviewRatings) != 0) {
              $device['userReviews'] = $userReviewRatings;
              $ratingData = $this->getRatingData($userReviewRatings);
              $device['averageUserRating'] = $ratingData['averageUserRating'];
              $device['totalRatingCount'] = $ratingData['totalRatingCount'];
            } else {
              $device['userReviews'] = [];
              $device['averageUserRating'] = 0;
              $device['totalRatingCount'] = 0;
            }

            $finalDevices[] = $device;
          } else {
            $finalDevices[] = $device;
          }
      }

      return $finalDevices;
    }

    public function getRatingData($userReviewRatings) {
      $averageUserRating = 0;
      $totalRatingCount = 0;

      if(!isset($userReviewRatings) || count($userReviewRatings) <= 0) {
        return [
          "averageUserRating" => $averageUserRating,
          "totalRatingCount"=> $totalRatingCount
        ];
      }

      $totalRatingCount = count($userReviewRatings);

      foreach($userReviewRatings as $review){
        $averageUserRating += $review['rating'];
      }

      $data = [
        "averageUserRating" => $averageUserRating / $totalRatingCount,
        "totalRatingCount" => $totalRatingCount
      ];

      return $data;
    }
    
    public function getSingleDevice($deviceId) {

      $device = null;

      if(!isset($deviceId) || $deviceId == "") {
        return $device;
      }

      $device = $this->connect()->filterById("devices", $deviceId)[0];

      if(!isset($device) || empty($device)) {
        return $device;
      }

      $userReviewRatings = $this->userReviewModel->findRatingsByDeviceId($deviceId);

      if(isset($userReviewRatings) && !empty($userReviewRatings)) {
        $device['userReviews'] = $userReviewRatings;
        $ratingData = $this->getRatingData($userReviewRatings);
        $device['averageUserRating'] = $ratingData['averageUserRating'];
        $device['totalRatingCount'] = $ratingData['totalRatingCount'];
      } else {
        $device['userReviews'] = [];
        $device['averageUserRating'] = 0;
        $device['totalRatingCount'] = 0;
      }

      return $device;
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