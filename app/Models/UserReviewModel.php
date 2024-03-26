<?php

class UserReviewModel extends Database {
    public function findRatingsByDeviceId($deviceId) {
       $userReviews = [];

       $filteredReviews = $this->connect()->readAll("userReviews");

       if($filteredReviews) {
            foreach ($filteredReviews as $filteredReview) {
                if(isset($filteredReview) && $filteredReview['deviceId'] == $deviceId) {
                    $userReviews[] = $filteredReview;
                }
            }
       }

       return $userReviews;
    }
}