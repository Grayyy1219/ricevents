<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['eventId']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['date']) && isset($_POST['location'])) {

        $eventId = mysqli_real_escape_string($con, $_POST['eventId']);
        $title = mysqli_real_escape_string($con, $_POST['title']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $date = mysqli_real_escape_string($con, $_POST['date']);
        $location = mysqli_real_escape_string($con, $_POST['location']);
        $quantity = mysqli_real_escape_string($con, $_POST['Quantity']); // Assuming Quantity is needed as it's mentioned in the POST data.

        $sql = "UPDATE events SET EventTitle = '$title', Description = '$description', Date = '$date', Location = '$location' WHERE EventID = $eventId";
        if (mysqli_query($con, $sql)) {
            http_response_code(200); // Success
            echo "Event updated successfully!";
        } else {
            http_response_code(500); // Internal Server Error
            echo "Error updating event information: " . mysqli_error($con);
        }
    } else {
        http_response_code(400); // Bad Request
        echo "Incomplete form data.";
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "Invalid request method.";
}
