<?php

require_once API_MODELS . 'DevicesModel.php';

$devicesModel = new DevicesModel();

$phones = $devicesModel->getAllDevices();

?>

<main>
<div id="phoneRecommendationHero" class='bg-secondary py-5 hero container-fluid d-flex flex-column justify-content-end'>
    <h3 class="text-center">Best Phone Recommendations You Can Get</h3>
    <p class="text-center">Trustworthy and indepth reviews and recommendations</p>
    <div class="d-flex justify-content-center">
    	<button class="btn btn-primary">Explore Now</button>
    </div>
</div>
<div id="recommendation" class="d-flex justify-content-center">
    <?php foreach ($phones as $phone) {
        echo "<div>
            $phone->name;
        </div>";
    } ?>
</div>
<div id="ranking"></div>
<div id="score"></div>
</main>