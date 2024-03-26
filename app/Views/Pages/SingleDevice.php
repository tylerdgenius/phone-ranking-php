<?php
require_once MODELS . 'DevicesModel.php';

$deviceModel = new DevicesModel();

$singleDevice = $deviceModel->getSingleDevice($urlData['id']);

?>

<main>
    <div class="container-fluid single-device-banner bg-dark">
        <?php echo "<img src='{$singleDevice['images'][0]}' class='img-fluid' />"; ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-2">
            	<?php 
            	   echo "<p>{$singleDevice['name']}</p>";
            	?>
            	<?php $date = $singleDevice['releaseDate']; echo "<p> Release date - {$date}</p>"; ?>
            </div>
            <div class="col-10">
            	<p>Specifications</p>
            </div>
        </div>
    </div>
</main>

