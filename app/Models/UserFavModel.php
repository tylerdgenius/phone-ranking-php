<?php

class UserFavModel extends Database {
    public DevicesModel $deviceModel;
    public UserModel $userModel;

    public function __construct()
    {
        $this->deviceModel = new DevicesModel();
        $this->userModel = new UserModel();
    }

    public function getAllFavs() {
        return $this->connect()->readAll("userFavorites");
    }

    public function getLastUserId() {
      $userFavorites = $this->getAllFavs();

      $lastFavorite = end($userFavorites);

      if(!isset($lastFavorite)) {
        return 1;
      } else {
        return $lastFavorite['id'];
      }
    }

    public function getAllUserFav($userId) {
        $favorites = $this->getAllFavs();

        $userFavorites = [];

        foreach ($favorites as $favorite) {
            if(isset($favorite['userId']) && $favorite['userId'] == $userId) {

                $device = null;

                if(isset($favorite['deviceId'])) {
                  $device = $this->deviceModel->getSingleDevice($favorite['deviceId']);
                }
                
                $favorite['device'] = $device;

                $userFavorites[] = $favorite;

            }
        }
    }

    public function confirmUniqueDeviceFavPerUser($userId, $deviceId) {
        $users = $this->userModel->getAllUsers();

        if(isset($users) && !empty($users)) {
            foreach($users as $user) {
                if(isset($user['id']) && $user['id'] == $userId 
                && isset($user['deviceId']) && $user['deviceId'] == $deviceId) {
                    return $user;
                } else {
                    return null;
                }
            }
        }
    }

    public function addUserFav($deviceId, $userId) {
        $data = [
            "status" => false,
            "message" => "",
            "payload" => []
        ];

        if(!isset($deviceId) || $deviceId == "") {
            $data["message"] = "The given data is required";
            $data['payload'][] = [
              "type" => "deviceId",
              "error" => "Device id is required"
            ];
            return $data;
        }

        if(!isset($userId) || $userId == "") {
            $data["message"] = "The given data is required";
            $data['payload'][] = [
              "type" => "userId",
              "error" => "User id is required"
            ];
            return $data;
        }

        $userFav = $this->confirmUniqueDeviceFavPerUser($userId, $deviceId);

        if($userFav) {
            $this->connect()->deleteById("userFavorites", $userFav['id']);
            $data["message"] = "The given data is required";
            $data['payload'][] = [
              "type" => "both",
              "error" => "Deleted previous like"
            ];
            return $data;
        }

        $savedUserFav = $this->connect()->create("userFavorites", [
          "id"=> $this->getLastUserId() + 1,
          "userId" => $userId,
          "deviceId" => $deviceId,
        ]);

        $data['status'] = true;
        $data['message'] = "Successfully added user favorite";
        $data['payload'] = $savedUserFav;
    }
}