<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $date = $_POST["date"];
    $location = $_POST["location"];

    $checkQuery = "SELECT * FROM events WHERE Date = '$date'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo '<script>alert("An event already exists on the selected date. Please select a different date.");</script>';
        echo '<script>window.history.back();</script>';
    } else {
        $query = "INSERT INTO events (EventTitle, Description, Date, Location) 
                  VALUES ('$title', '$description', '$date', '$location')";

        if (mysqli_query($con, $query)) {
            echo '<script>alert("Event Created successfully!");</script>';
            echo "<script>window.location.href = 'admin2.php?view_events';</script>";
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
