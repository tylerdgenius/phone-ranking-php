<?php

$list = [
    "14" => [
        "Focus Mode"
    ]
]

?>

<main>
    <h3>Common Differences between iOS 14 and 15</h3>
    <div>
        <table>
            <thead>
                <tr>
                    <th>iOS 14</th>
                    <th>iOS 15</th>
                </tr>
            </thead>
            <tbody>


                <?php

                foreach($list as $list) {
                    echo "
                        <tr>
                            <td>
                                {$list['14'][0]}
                            </td>
                            <td>
                                {$list['15'][0]}
                            </td>
                        </tr>
                    ";
                }
                
                

                ?>
            </tbody>
            
            
        </table>
    </div>
</main>