<?php

session_start();

require_once MODELS . 'DevicesModel.php';
require_once MODELS . 'UserReviewModel.php';

$deviceModel = new DevicesModel();

$singleDevice = $deviceModel->getSingleDevice($urlData['id']);

$fields = [];

if($singleDevice) {
    $fields['Manufacturer'] = $singleDevice['manufacturer'];
    $fields['OS Version'] = $singleDevice['osVersion'];
    $fields['Description'] = $singleDevice['description'];
    $fields['Our Rating'] = $singleDevice['recommendationScore'];
    $fields['Weight In Grams'] = $singleDevice['weightInGrams'];
    $fields['CPU'] = $singleDevice['cpu'];
    $fields['Memory'] = $singleDevice['memoryVariations'];
    $fields['Back Camera'] = $singleDevice['backCameraSpecs'];
    $fields['Front Camera'] = $singleDevice['frontCameraSpecs'];
    $fields['GPU'] = $singleDevice['gpu'];
    $fields['Chipset'] = $singleDevice['chipset'];
    $fields['Talk Time'] = $singleDevice['talkTime'];
    $fields['Battery (Uptime)'] = $singleDevice['batteryType'];
    $fields['Dimensions'] = $singleDevice['dimensions'];
}

/**
 * Submitting review data
 */

$errors = [];

$success = null;

if(isset($_POST) && isset($_POST['review']) && isset($_POST['rating']) && isset($_SESSION['id'])) {

    $userReviewModel = new UserReviewModel();

    $reviewData = $userReviewModel->createReview($_SESSION['id'], 
    $singleDevice['id'], $_POST['review'], $_POST['rating']);

    if(isset($reviewData) && !$reviewData['status']) {
       $errors = $reviewData['payload'];
    }


    if(isset($reviewData) && $reviewData['status'] == true) {
        // header("Location: login");
        $success = true;
        unset($_POST['review']);
        unset($_POST['rating']);
        unset($_POST);

        header("Location: {$_SERVER['REQUEST_URI']}");
        exit();
    }
}


?>

<main>
    <div class="bg-dark" style="height: 350px;">
        <?php echo "<img src='{$singleDevice['images'][0]}' class='w-100 h-100 object-fit-cover' />"; ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-4 pt-5">
            	<?php 
            	   echo "<p class='fs-1'>{$singleDevice['name']}</p>";
            	?>
            	<?php

                $date = date("M d, Y", strtotime($singleDevice['releaseDate'])); 
                
                echo "<small class='text-dark text-opacity-50 '> Release date - {$date}</small>"; 
                
                ?>
                <p class="mt-5 text-dark text-opacity-50 ">You can buy on</p>
                <div class="d-flex flex-wrap gap-3">
                    <?php 

                    if(!isset($singleDevice['retailers']) || empty($singleDevice['retailers'])) {
                        echo "";
                    }

                    foreach ($singleDevice['retailers'] as $retailer) 
                        echo "<div>
                            <a href='{$retailer['link']}' class='btn btn-danger align-content-center d-flex'>
                            <i class='material-icons'>attach_money</i>
                            {$retailer['price']}
                            </a>
                        </div>
                        ";
                    ?>
                </div>
                <p class="mt-5 text-dark text-opacity-50 ">Read more on</p>
                <div class="d-flex flex-wrap gap-3">
                    <?php 

                    if(!isset($singleDevice['externalReviewUrls']) || empty($singleDevice['externalReviewUrls'])) {
                        echo "";
                    }

                    foreach ($singleDevice['externalReviewUrls'] as $review) 

                        echo "<div>
                            <a href='{$review['link']}' class='btn btn-light'>
                            {$review['name']}
                            </a>
                        </div>
                        ";
                    
                    
                    ?>
                </div>
                <div class="d-flex flex-wrap gap-4">
                    <div class="mt-5">
                        <p class="mb-0">Total no of user ratings</p>
                        <p><?php echo $singleDevice['totalRatingCount'] ?></p>
                    </div>
                    <div class="mt-5">
                        <p class="mb-0">Average user rating score</p>
                        <p><?php echo $singleDevice['averageUserRating'] ?></p>
                    </div>
                </div>
                <a href="#userReviews" class="text-decoration-none text-danger">View Reviews
                </a>
            </div>
            <div class="col-8">
            	<p class='py-4 bg-danger text-white px-4'>Specifications</p>
                <div class="container-fluid row">
                    <?php 

                    if(isset($fields) && !empty($fields)) {
                        foreach($fields as $key => $value) {
                            if($key == "Back Camera" || $key == "Front Camera") {
                                $value  = implode(" <br>", $value);
                            }

                            echo "<div class='row border-bottom pt-3 border-dark border-opacity-25 ' >
                                <small class='col-4 fw-bold text-dark text-opacity-50 '>{$key}</small>
                                <p class='col-8'>{$value}</p>
                            </div>";
                        }
                    }
                    
                    ?>
                </div>
            </div>
        </div>
       <div class="border border-bottom-1 w-100 mt-5"></div>
        <div class="row my-5" id="userReviews">
            <h3>User Reviews</h3>
            
            <form class="mt-3" id='addReview' method="POST">
                <label for="review">What do you like or hate about this device?</label>
                <br>
                <div style="height:140px;"> 
                    <textarea style="outline: none; resize: none;"
                        class="w-100 border-1 border-opacity-10 px-3 py-3 h-100 rounded-2"
                        name='review'
                        placeholder="Type a review for this device" required></textarea>
                </div>
                <div class="mt-3">
                    <label for='rating'>What rating would it give it?</label>
                    <br>
                     <select name='rating' class="w-100 px-2 py-2 rounded-2">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
                <div class="d-flex justify-content-end ">
                    <?php 
                    if(isset($_SESSION['id'])) {
                        echo "<button type='submit' 
                        class='btn btn-danger mt-3 align-self-end'>
                        Submit
                    </button>";
                    } else {
                        echo "<p class='mt-3'>Login to post a review about this device</p>";
                    }

                    
                    ?>
                </div>
            </form>
            <h5 class="mt-3 text-dark opacity-50 ">Past reviews</h5>
            <div class="mt-3">
                <?php
                    if(!isset($singleDevice['userReviews']) || empty($singleDevice['userReviews'])) {
                        echo "<p>There are currently no reviews for this device</p>";
                    }
                    
                    foreach ($singleDevice['userReviews'] as $review) {

                        $userData = "";

                        if(isset($review['username'])) {
                            $userData = "
                                <div style='width: -moz-fit-content; width: fit-content;' class='d-flex align-items-center border border-black border-opacity-25 px-3 py-2 rounded-2'>
                                    <i class='material-icons'>account_circle</i>
                                    <p class='mb-0'>{$review['username']}</p>
                                </div>
                            ";
                        }

                        echo "<div class='border border-bottom mb-2 rounded-1 py-2 px-3'>
                            <p>{$review['review']}</p>

                                {$userData}

                        </div>";
                    }
                ?>
            </div>
        </div>
    </div>
</main>

