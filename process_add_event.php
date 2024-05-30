<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $date = $_POST["date"];
    $location = $_POST["location"];

    $query = "INSERT INTO events (EventTitle, Description, Date, Location) 
              VALUES ('$title', '$description', '$date', '$location')";

    if (mysqli_query($con, $query)) {
        echo '<script>alert("Event Created successfully!");</script>';
        echo "<script>window.location.href = 'admin2.php?view_events';</script>";
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}
