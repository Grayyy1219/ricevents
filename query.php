<?php

$query = mysqli_query($con, "select * from currentuser where UserID = '1'");
$row = mysqli_fetch_assoc($query);
$location = $row["profile"];
$username = $row["username"];
$FName = $row["FName"];
$email = $row["email"];



$queryPage = mysqli_query($con, "SELECT * FROM page WHERE ItemID IN (1, 2, 3, 4, 5)");
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
</style>";
