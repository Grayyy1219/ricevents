<?php
include("connect.php");

$targetUserId = $_POST['UserID'];
$first_name = $_POST['first_name'];
$email = $_POST['email'];
$role = $_POST['role'];

if (isset($_POST["submit"])) {
    if ($_FILES['img']['size'] > 0) {
        $name = $_FILES['img']['name'];
        $tmp_name = $_FILES['img']['tmp_name'];
        $location = "uploads/profile/$name";
        move_uploaded_file($tmp_name, $location);
    } else {
        $queryRetrieveImage = mysqli_query($con, "SELECT profile FROM users WHERE UserID = '$targetUserId'");
        if ($queryRetrieveImage && mysqli_num_rows($queryRetrieveImage) > 0) {
            $row = mysqli_fetch_assoc($queryRetrieveImage);
            $location = $row['profile'];
        }
    }

    $queryRetrieveUsername = mysqli_query($con, "SELECT * FROM users WHERE UserID = '$targetUserId'");
    if ($queryRetrieveUsername && mysqli_num_rows($queryRetrieveUsername) > 0) {
        $row = mysqli_fetch_assoc($queryRetrieveUsername);
        $targetFName = $row['FName'];

        $queryUpdateUsers = mysqli_query($con, "UPDATE users SET profile = '$location', FName = '$first_name', email = '$email', admin ='$role'  WHERE UserID = '$targetUserId'");

        if ($queryUpdateUsers) {
            echo '<script>alert("Profile updated successfully for User: ' . $targetFName . ' ' . $targetLName . '");</script>';
            echo '<script>window.location.href = "admin2.php?view_user";</script>';
        } else {
            echo '<script>alert("Error updating profile. Please try again later.");</script>';
        }
    } else {
        echo '<script>alert("Error retrieving user information. Please try again later.");</script>';
    }
} else {
    echo '<script>alert("Error updating profile. Please try again later.");</script>';
    echo '<script>window.location.href = "admin2.php?view_user";</script>';
}
