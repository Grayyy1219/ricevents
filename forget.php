<?php
include("connect.php");
include("query.php");

$resetemail = $_POST['email'];

function generateRandomPassword($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\ricevents\PHPMailer\src\Exception.php';
require 'C:\xampp\htdocs\ricevents\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\ricevents\PHPMailer\src\SMTP.php';

$mail = new PHPMailer(true);

$sql = "SELECT * FROM users WHERE email='$resetemail'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'noreply.thebookhaven@gmail.com';
        $mail->Password = 'glyt mguu ymqy noks';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $row = $result->fetch_assoc();
        $tempPassword = generateRandomPassword();
        $hashedPassword = password_hash($tempPassword, PASSWORD_DEFAULT);
        $updatePasswordQuery = "UPDATE users SET Password='$hashedPassword' WHERE email='$resetemail'";
        mysqli_query($con, $updatePasswordQuery);

        $mail->setFrom('noreply.thebookhaven@gmail.com', 'Northstar drug');
        $mail->addAddress($resetemail, '');

        $message = '
        <html>
        <body>
            <p>Dear Maam/Sir,</p>
            <p>Your temporary password has been reset. Please use the following temporary password to log in:</p>
            <p>Temporary Password: ' . $tempPassword . '</p>
            <p>After logging in, we recommend changing your password for security reasons.</p>
            <p>If you did not request a password reset, please contact support immediately.</p>
            <p>Thank you!</p>
        </body>
        </html>
    ';
        $mail->isHTML(true);
        $mail->Subject = 'Temporary Password Reset - Northstar drug Library Account';
        $mail->Body = $message;
        $mail->AltBody = 'Your temporary password has been reset. Temporary Password: ' . $tempPassword;

        $mail->send();

        echo '<script>alert("Temporary password sent to your email!");</script>';
        echo '<script>window.location.href = "landingpage.php";</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "<script>alert('User with this email does not exist');</script>";
    echo '<script>window.history.back();</script>';
}
