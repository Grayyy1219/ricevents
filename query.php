<?php
$queryPage = mysqli_query($con, "SELECT * FROM page WHERE ItemID");
while ($rowPage = mysqli_fetch_assoc($queryPage)) {
    if ($rowPage["ItemID"] == 1) {
        $logo = $rowPage["value"];
    } elseif ($rowPage["ItemID"] == 2) {
        $companyname = $rowPage["value"];
    } elseif ($rowPage["ItemID"] == 3) {
        $backgroundimg = $rowPage["value"];
    } elseif ($rowPage["ItemID"] == 4) {
        $backgroundcolor = $rowPage["value"];
    } elseif ($rowPage["ItemID"] == 5) {
        $color = $rowPage["value"];
    }
}

















echo "<style>
    :root {
        --text: $color;
        --background: $backgroundcolor;
        --primary: #333;
        --secondary: #005dab;
        --btext: #ffffff;
    }
    p,
    h1 {
        color: var(--text);
    }
</style>";
