<?php
include("connect.php");


if (isset($_GET['event_id'])) {
    $eventId = mysqli_real_escape_string($con, $_GET['event_id']);

    $sql = "SELECT * FROM events WHERE EventID = '$eventId'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $eventDetails = $result->fetch_assoc();

        $popupHTML = "<div class='popup-overlay'>";
        $popupHTML .= "<div class='popup-content'>";
        $popupHTML .= "<h2>" . $eventDetails['EventTitle'] . "</h2>";
        $popupHTML .= "<p>" . $eventDetails['Description'] . "</p>";
        $popupHTML .= "<button onclick='closePopup()'>Close</button>";
        $popupHTML .= "</div></div>";

        echo $popupHTML;
        echo "<script>console.log('hi');</script>";
    } else {
        echo "<div class='popup-overlay'><div class='popup-content'>Event not found</div></div>";
    }
} else {
    echo "<div class='popup-overlay'><div class='popup-content'>Event ID not provided</div></div>";
}

$con->close();
