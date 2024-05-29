<?php
include("connect.php");

$verificationCode = $_GET['code'];

if (!empty($verificationCode)) {
    $stmt = $con->prepare("UPDATE users SET verified = 1 WHERE verification_code = ?");
    $stmt->bind_param("s", $verificationCode);

    if ($stmt->execute()) {
        echo '<script>alert("Your email has been successfully verified. Welcome to our Event Management System!");</script>';
        echo '<script>window.location.href = "landingpage.php";</script>';
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid verification code";
}
$con->close();
