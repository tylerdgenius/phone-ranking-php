<?php

require_once MODELS . 'UserModel.php';

class UserReviewModel extends Database {
    public function getAllUserReviews() {
        return $this->connect()->readAll("userReviews");
    }

    public function getLastUserId() {
      $userReviews = $this->getAllUserReviews();

      $lastFavorite = end($userReviews);

      if(!isset($lastFavorite)) {
        return 1;
      } else {
        return $lastFavorite['id'];
      }
    }

    public function findRatingsByDeviceId($deviceId) {

      require_once MODELS . 'UserModel.php';

      $userModel = new UserModel();

      $users = $userModel->getAllUsers();

      $userReviews = [];

      $filteredReviews = $this->connect()->readAll("userReviews");

      if($filteredReviews) {
        foreach ($filteredReviews as $filteredReview) {
          if(isset($filteredReview) && $filteredReview['deviceId'] == $deviceId) {
            foreach($users as $user) {
              if($user['id'] == $filteredReview['userId']) {
                $filteredReview['username'] = $user['username'];
              } else {
                $filteredReview['username'] = "";
              }
            }

            $userReviews[] = $filteredReview;
          }
        }
      }

      usort($userReviews, [$this, 'compareIdsDescending']);

      return $userReviews;
    }

    public function createReview($userId, $deviceId, $review, $rating) {
        $data = [
            "status" => false,
            "message" => "",
            "payload" => []
        ];

        if(!isset($userId) || $userId == "") {
          $data["message"] = "The given data is required";
          
          $data['payload'][] = [
            "type" => "both",
            "error" => "An unknown error has occured while creating review"
          ];
          
          return $data;
        }

        if(!isset($deviceId) || $deviceId == "") {
          $data["message"] = "The given data is required";
          
          $data['payload'][] = [
            "type" => "both",
            "error" => "An unknown error has occured while creating review"
          ];
          
          return $data;
        }

        if(!isset($review) || $review == "") {
          $data["message"] = "The given data is required";
          
          $data['payload'][] = [
            "type" => "review",
            "error" => "A review is required"
          ];
          
          return $data;
        }

        if(!isset($rating) || $rating == "") {
          $data["message"] = "The given data is required";
          
          $data['payload'][] = [
            "type" => "rating",
            "error" => "A rating is required"
          ];
          
          return $data;
        }

        $savedReview = $this->connect()->create("userReviews", [
          "id"=> $this->getLastUserId() + 1,
          "userId" => $userId,
          "deviceId" => $deviceId,
          "rating" => $rating,
          "review" => $review
        ]);

        $data['status'] = true;
        $data['message'] = "Successfully created user";
        $data['payload'] = $savedReview;

        return $data;
    }
}