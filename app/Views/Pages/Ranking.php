<?php

require_once MODELS . 'DevicesModel.php';

$devicesModel = new DevicesModel();

$phones = $devicesModel->getAllDevices();

$baseHorizontalPadding = "px-3";

$baseHeadingClass = "py-2 $baseHorizontalPadding";
?>

<main class="mt-5">
   <table class="container">
    <thead>
        <tr class="bg-black bg-opacity-10">
            <th class="<?php echo $baseHeadingClass; ?>">Name</th>
            <th class="<?php echo $baseHeadingClass; ?>">Manufacturer</th>
            <th class="<?php echo $baseHeadingClass; ?>">OS Version</th>
            <th class="<?php echo $baseHeadingClass; ?>">Battery Capacity</th>
            <th class="<?php echo $baseHeadingClass; ?>">Dimensions</th>
            <th class="<?php echo $baseHeadingClass; ?>">Rating</th>
            <th class="<?php echo $baseHeadingClass; ?>">Average User Rating</th>
        </tr>
    </thead>
    <tbody>
        <?php

        foreach($phones as $phone) {
            
            echo "<tr>
                <td class='$baseHeadingClass'>
               {$phone['name']}
                </td>
                <td class='$baseHeadingClass'>
                {$phone['manufacturer']}
                </td>
                <td class='$baseHeadingClass'>iOS
                {$phone['osVersion']}
                </td>
                <td class='$baseHeadingClass'>
                {$phone['batteryType']}
                </td>
                <td class='$baseHeadingClass'>
                {$phone['dimensions']}
                </td>
                <td class='$baseHeadingClass'></td>
                <td class='$baseHeadingClass'></td>
            </tr>";
        }
            
        ?>
    </tbody>
   </table>
</main>