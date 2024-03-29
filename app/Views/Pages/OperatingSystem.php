<?php

$list = [
    [
        "label" => "Focus Mode",
        "14" => "No Focus Mode",
        "15" => "Has Focus Mode"
    ],
    [
        "label" => "Facetime",
        "14" => "FaceTime lacks spatial audio, Voice Isolation, Wide Spectrum modes, and SharePlay",
        "15" => "Minor Improvements"
    ],
    [
        "label" => "Notification Summary",
        "14" => "No Notification Summary",
        "15" => "Has Notification Summary"
    ],
    [
        "label" => "Live Text",
        "14" => "No Live Text Feature",
        "15" => "Has Live Text Feature"
    ],
    [
        "label" => "Apple Maps",
        "14" => "Apple Maps lacks new 3D views, improved transit directions, and enhanced navigation features",
        "15" => "Apple Map Updates"
    ],
    [
        "label" => "Weather App",
        "14" => "Older Weather app design",
        "15" => "Weather App Redesign"
    ],
    [
        "label" => "Safari",
        "14" => "Lacks some privacy features like App Privacy Report and Mail Privacy Protection",
        "15" => "Enhanced Privacy Features"
    ],
    [
        "label" => "ID & Scanning",
        "14" => "No built-in ID and Document Scanning feature",
        "15" => "ID and Document Scanning"
    ],
    [
        "label" => "Accessibility",
        "14" => "Accessibility features may be less advanced compared to iOS 15",
        "15" => "Accessibility Improvements"
    ]
]

?>

<main>
    <div class="container mt-5">
        <h3 class="text-center">iOS Versions Comparison</h3>
        <div class="d-flex justify-content-center mt-5">
            <div class="border border-secondary border-opacity-25 rounded-2">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th style="width:40%;" class="py-3 px-3 bg-light border-start border-secondary-subtle border-bottom ">iOS 14</th>
                            <th style="width:40%;" class="py-3 px-3 bg-light border-start border-secondary-subtle border-bottom">iOS 15</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php

                    foreach($list as $list) {
                        echo "
                            <tr>
                                <td class='bg-danger text-white py-4 px-3 border-bottom border-secondary-subtle'>
                                    {$list['label']}
                                </td>
                                <td class='py-3 px-3 border-bottom border-secondary-subtle'>
                                    {$list['14']}
                                </td>
                                <td class='py-3 px-3 border-bottom border-secondary-subtle border-start'>
                                    {$list['15']}
                                </td>
                            </tr>
                        ";
                    }

                    ?>
                </tbody>
            </table>
            </div>
            
        </div>
    </div>

</main>