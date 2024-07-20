<?php
include("connect.php");
include("query.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\ricevents\PHPMailer\src\Exception.php';
require 'C:\xampp\htdocs\ricevents\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\ricevents\PHPMailer\src\SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'webdev.cite@gmail.com';
    $mail->Password = 'iwxeehexxorczpcn';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    // Recipients
    $mail->setFrom("$email", 'Ric Events');
    $mail->addAddress("$email", '');

    $verificationCode = rand(10000, 99999);
    $sql = "UPDATE users SET verification_code = '$verificationCode' WHERE email = '$email'";
    mysqli_query($con, $sql);

    $verificationLink = "http://localhost/ricevents/verify.php?code=$verificationCode";

    $mail->isHTML(true);
    $mail->Subject = 'Verify Your Event Management System Account - Start Planning Your Events!';
    $mail->Body = "Thank you for signing up with our Event Management System! To keep your account secure, please verify your email address by clicking on the following link: <br> <b><a href='$verificationLink'>Verify Your Email</a></b> <br> Your verification code is: <h1>$verificationCode</h1> <br> If you did not sign up for our Event Management System, please disregard this email.<br><br>Thank you for choosing our Event Management System to plan your events.";
    $mail->AltBody = 'Thank you for signing up with our Event Management System! To keep your account secure, please verify your email address using the provided verification link and code. If you did not sign up, please disregard this email.';


    // Send the email
    $mail->send();

    echo '<script>alert("Verification link sent to you email!");</script>';
    echo '<script>window.history.back();</script>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
