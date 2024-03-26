<?php

session_start();

require_once MODELS . 'DevicesModel.php';

$devicesModel = new DevicesModel();

$phones = $devicesModel->getAllDevices();

?>

<main>
<div id="phoneRecommendationHero" class='bg-secondary py-5 hero container-fluid d-flex flex-column justify-content-center'>
    <div class="hero-content">
        <h3 class="text-center fs-1">Welcome iOS Hub</h3>
        <p class="text-center">Trustworthy and in-depth reviews and recommendations for iOS devices</p>
    </div>
</div>
<div class='bg-danger d-flex flex-column justify-content-center align-items-center text-white p-5'>
    <p class="text-center">
    iOS Hub is your ultimate destination for all things iOS! Whether you're an avid iPhone user, iPad aficionado, or simply curious about the latest developments in the Apple ecosystem, you've come to the right place. You can explore our comprehensive collection of articles covering everything from the latest iOS releases and app recommendations to troubleshooting common issues and optimizing device performance.
    </p>
    <div class="container d-flex justify-content-center">
        <a href="operating-system" class="text-center text-decoration-none btn btn-light">View details</a>
    </div>
</div>
<div id="recommendation" class="pt-5">
    <h4 class="text-center">Highest Recommended Devices in the Market Right Now</h4>
    <p class="text-center">Our in-depth review and recommendation score for each device is also provided to assist you in your decision making</p>
    <div class="d-flex justify-content-center container mt-5">
    	<div class="row">
            <?php foreach ($phones as $phone) {
                $cutText = substr($phone['description'], 0, 145);
                
                echo "<div class='col-lg-4 p-5  border border-success border-opacity-10'>
                    <img src='{$phone['images'][0]}' class='img-fluid' />
                    <div>
                        <p class='text-center'>{$phone['name']}</p>
                        <p class='text-center'>$cutText...</p>
                        <div class='d-flex justify-content-center'><a href='devices/{$phone['id']}' class='btn btn-danger '>Read more</a></div>
                    </div>             
                </div>";
            } ?>
    	</div>
    </div>
</div>
<div class="bg-dark p-5 mt-5">

</div>
</main>