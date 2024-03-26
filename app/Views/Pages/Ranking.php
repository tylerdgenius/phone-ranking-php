<?php

require_once MODELS . 'DevicesModel.php';

$devicesModel = new DevicesModel();

$phones = $devicesModel->getAllDevices();

$baseHorizontalPadding = "px-3";

$baseHeadingClass = "py-2 $baseHorizontalPadding";

?>

<main class="mt-5">
    <h3 class="text-center">Current Phone Rankings</h3>
   <table class="container mt-5" >
    <thead>
        <tr class="bg-secondary bg-opacity-10">
            <th class="<?php echo $baseHeadingClass; ?>">Name</th>
            <th class="<?php echo $baseHeadingClass; ?>">Manufacturer</th>
            <th class="<?php echo $baseHeadingClass; ?>">OS Version</th>
            <th class="<?php echo $baseHeadingClass; ?>">Battery Capacity</th>
            <th class="<?php echo $baseHeadingClass; ?>">Dimensions</th>
            <th class="<?php echo $baseHeadingClass; ?>">Rating</th>
            <th class="<?php echo $baseHeadingClass; ?>">Average User Rating</th>
            <th class="<?php echo $baseHeadingClass; ?>">
              
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($phones as $phone) {
                echo "
                        <tr>
                            <td class='$baseHeadingClass'>{$phone['name']}</td>
                                <td class='$baseHeadingClass'>{$phone['manufacturer']}</td>
                                <td class='$baseHeadingClass'>iOS {$phone['osVersion']}</td>
                                <td class='$baseHeadingClass'>{$phone['batteryType']}</td>
                                <td class='$baseHeadingClass'>{$phone['dimensions']}</td>
                                <td class='$baseHeadingClass'>{$phone['averageUserRating']}</td>
                                <td class='$baseHeadingClass'>{$phone['totalRatingCount']}</td>
                                <td class='$baseHeadingClass'>
                                <a class='btn btn-danger ' href='devices/{$phone['id']}'>View</a>
                                </td>
                        </tr>

                ";
            }
        ?>
    </tbody>
   </table>
</main>