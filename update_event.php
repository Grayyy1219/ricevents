<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['eventId']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['date']) && isset($_POST['location'])) {

        $eventId = mysqli_real_escape_string($con, $_POST['eventId']);
        $title = mysqli_real_escape_string($con, $_POST['title']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $date = mysqli_real_escape_string($con, $_POST['date']);
        $location = mysqli_real_escape_string($con, $_POST['location']);
        $quantity = mysqli_real_escape_string($con, $_POST['Quantity']);
        $slot = mysqli_real_escape_string($con, $_POST['slot']);

        if ($_FILES['imgloc']['size'] > 0) {
            $name = $_FILES['imgloc']['name'];
            $tmp_name = $_FILES['imgloc']['tmp_name'];
            $imgloc = "uploads/events/$name";
            move_uploaded_file($tmp_name, $location);
        } else {
            $queryRetrieveImage = mysqli_query($con, "SELECT EventImg FROM events WHERE EventID = '$eventId'");
            if ($queryRetrieveImage && mysqli_num_rows($queryRetrieveImage) > 0) {
                $row = mysqli_fetch_assoc($queryRetrieveImage);
                $imgloc = $row['EventImg'];
            }
        }


        $sql = "UPDATE events SET EventTitle = '$title', Description = '$description', Date = '$date', Location = '$location', Available = '$slot', EventImg = '$imgloc' WHERE EventID = $eventId";
        if (mysqli_query($con, $sql)) {
            http_response_code(200);
            echo "Event updated successfully!";
        } else {
            http_response_code(500);
            echo "Error updating event information: " . mysqli_error($con);
        }
    } else {
        http_response_code(400);
        echo "Incomplete form data.";
    }
} else {
    http_response_code(405);
    echo "Invalid request method.";
}
