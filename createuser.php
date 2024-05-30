<?php
include("connect.php");
include("query.php");

$firstname = mysqli_real_escape_string($con, $_POST['txtfname']);
$lastname = mysqli_real_escape_string($con, $_POST['txtlname']);
$fname = "$firstname $lastname";
$txtusername = mysqli_real_escape_string($con, $_POST['txtusername']);
$password = $_POST['txtpassword'];
$email = mysqli_real_escape_string($con, $_POST['txtemail']);
$profile = 'css/img/new.png';

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    $checkQuery = "SELECT username, email FROM users WHERE username = ? OR email = ?";
    $checkStmt = mysqli_prepare($con, $checkQuery);
    mysqli_stmt_bind_param($checkStmt, "ss", $txtusername, $email);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);

    if (mysqli_stmt_num_rows($checkStmt) > 0) {
        mysqli_stmt_close($checkStmt);
        echo '<script>alert("Username or email already exists. Please choose a different one.");</script>';
        echo '<script>window.location.href = "Landingpage.php";</script>';
    } else {
        mysqli_stmt_close($checkStmt);

        $insertQuery = "INSERT INTO users (Fname,  username, password, email, profile) VALUES (?, ?, ?, ?, ?)";
        $insertStmt = mysqli_prepare($con, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "sssss", $fname,  $txtusername, $hashedPassword, $email, $profile);

        if (mysqli_stmt_execute($insertStmt)) {
            if ($username == "admin") {
                echo '<script>alert("Signup Successfully");</script>';
                echo '<script>window.location.href = "admin2.php?view_user";</script>';
            } else {
                echo '<script>alert("Signup Successfully!");</script>';
                echo '<script>window.location.href = "Landingpage.php";</script>';
            }
        } else {
            echo '<script>alert("Error during signup. Please try again later.");</script>';
            echo '<script>window.location.href = "Landingpage.php";</script>';
        }

        mysqli_stmt_close($insertStmt);
    }
} catch (Exception $e) {
    echo '<script>alert("An error occurred: ' . $e->getMessage() . '");</script>';
    echo '<script>window.location.href = "Landingpage.php";</script>';
} finally {
    mysqli_close($con);
}
