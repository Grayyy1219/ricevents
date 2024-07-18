<?php
include 'connect.php';
include("query.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $date = $_POST["date"];
    $location = $_POST["location"];
    if (isset($_POST["slot"])) {
        $Available = $_POST["slot"];
    } else {
        $Available = 50;
    }

    if ($_FILES['imgloc']['size'] > 0) {
        $name = $_FILES['imgloc']['name'];
        $tmp_name = $_FILES['imgloc']['tmp_name'];
        $EventImg = "uploads/events/$name";
        move_uploaded_file($tmp_name, $EventImg);
    }

    $checkQuery = "SELECT * FROM events WHERE Date = '$date'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo '<script>alert("An event already exists on the selected date. Please select a different date.");</script>';
        echo '<script>window.history.back();</script>';
    } else {

        $query = "INSERT INTO events (EventTitle, Description, Date, Location, EventImg, Available, UserID) 
                  VALUES ('$title', '$description', '$date', '$location', '$EventImg', $Available, $UserID)";
        echo  $query;
        if (mysqli_query($con, $query)) {
            echo '<script>alert("Event Created successfully!");</script>';
            if ($username != 'admin') {
                echo "<script>window.location.href = 'landingpage.php';</script>";
            }
            echo "<script>window.location.href = 'admin2.php?view_events';</script>";
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
