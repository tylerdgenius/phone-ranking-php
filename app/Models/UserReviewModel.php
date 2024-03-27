<?php

require_once MODELS . 'UserModel.php';

class UserReviewModel extends Database {
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function findRatingsByDeviceId($deviceId) {

        $users = $this->userModel->getAllUsers();

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

       return $userReviews;
    }

    public function createReview($userId, $deviceId, $review, $rating) {

    }
}